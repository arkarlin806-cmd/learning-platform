<?php

namespace App\Http\Controllers;

use App\Models\CertificateFrame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\CourseOrder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CertificateFrameController extends Controller
{

    public function create()
    {
        return view(
            'admin.certificate.create'
        );
    }
    public function index(Request $request)
    {
        $query = CertificateFrame::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('frame_name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('active', $request->status);
        }

        $certificateFrames = $query
            ->latest()
            ->paginate(10);
        // ->withQueryString();

        return view('admin.certificate.index', compact('certificateFrames'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category'   => 'required|string|max:255',
            'frame_name' => 'required|string|max:255',

            'background'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'border_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
            'watermark'   => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
            'logo'        => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
            'seal'        => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',

            'primary_color'   => 'nullable|string|max:20',
            'secondary_color' => 'nullable|string|max:20',
            'accent_color'    => 'nullable|string|max:20',

            'active' => 'nullable|boolean',
        ]);


        /*
    |--------------------------------------------------------------------------
    | Basic data
    |--------------------------------------------------------------------------
    */

        $data = [
            'category'        => $request->input('category'),
            'frame_name'      => $request->input('frame_name'),
            'primary_color'   => $request->input('primary_color'),
            'secondary_color' => $request->input('secondary_color'),
            'accent_color'    => $request->input('accent_color'),
            'active'          => $request->boolean('active'),
        ];


        /*
    |--------------------------------------------------------------------------
    | Certificate images
    |--------------------------------------------------------------------------
    */

        $images = [
            'background'   => 'certificate_frames/backgrounds',
            'border_image' => 'certificate_frames/borders',
            'watermark'    => 'certificate_frames/watermarks',
            'logo'         => 'certificate_frames/logos',
            'seal'         => 'certificate_frames/seals',
        ];


        foreach ($images as $field => $folder) {

            if ($request->hasFile($field)) {

                $path = $request
                    ->file($field)
                    ->store($folder, 'b2');

                if (!$path) {

                    return back()
                        ->withInput()
                        ->with(
                            'error',
                            "Failed to upload {$field} to B2."
                        );
                }

                $data[$field] = $path;
            }
        }


        /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

        CertificateFrame::create($data);


        return redirect()
            ->route('admin.certificate.frames.index')
            ->with(
                'success',
                'Certificate Frame Created Successfully.'
            );
    }
    public function update(Request $request, CertificateFrame $certificateFrame)
    {
        $request->validate([
            'category'        => 'required|string|max:255',
            'frame_name'      => 'required|string|max:255',

            'background'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'border_image'    => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
            'watermark'       => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
            'logo'            => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
            'seal'            => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',

            'primary_color'   => 'required|string|max:20',
            'secondary_color' => 'required|string|max:20',
            'accent_color'    => 'required|string|max:20',

            'active'          => 'nullable|boolean',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Basic data
        |--------------------------------------------------------------------------
        */

        $data = [
            'category'        => $request->input('category'),
            'frame_name'      => $request->input('frame_name'),
            'primary_color'   => $request->input('primary_color'),
            'secondary_color' => $request->input('secondary_color'),
            'accent_color'    => $request->input('accent_color'),
            'active'          => $request->boolean('active'),
        ];


        /*
        |--------------------------------------------------------------------------
        | Certificate Images
        |--------------------------------------------------------------------------
        | IMPORTANT:
        | Same folder as STORE:
        |
        | certificate_frames
        |
        */

        $images = [
            'background',
            'border_image',
            'watermark',
            'logo',
            'seal',
        ];


        $oldFiles = [];

        $disk = Storage::disk('b2');


        /*
        |--------------------------------------------------------------------------
        | Upload new images
        |--------------------------------------------------------------------------
        */

        foreach ($images as $field) {

            if ($request->hasFile($field)) {

                /*
                | Keep old image path
                */

                if (!empty($certificateFrame->{$field})) {

                    $oldFiles[] = $certificateFrame->{$field};
                }


                /*
                | Upload NEW image
                |
                | SAME AS STORE
                */

                $newPath = $request
                    ->file($field)
                    ->store(
                        'certificate_frames',
                        'b2'
                    );


                /*
                | Check upload
                */

                if (!$newPath) {

                    return back()
                        ->withInput()
                        ->with(
                            'error',
                            "Failed to upload {$field} to B2."
                        );
                }


                /*
                | Save new path
                */

                $data[$field] = $newPath;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Update Database
        |--------------------------------------------------------------------------
        */

        $certificateFrame->update($data);


        /*
        |--------------------------------------------------------------------------
        | Delete OLD images from B2
        |--------------------------------------------------------------------------
        */

        foreach ($oldFiles as $oldPath) {

            try {

                if (
                    !empty($oldPath) &&
                    $disk->exists($oldPath)
                ) {

                    $disk->delete($oldPath);
                }
            } catch (\Throwable $e) {

                Log::warning(
                    'Old certificate image could not be deleted from B2',
                    [
                        'frame_id' =>
                        $certificateFrame->id,

                        'path' =>
                        $oldPath,

                        'error' =>
                        $e->getMessage(),
                    ]
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.certificate.frames.index')
            ->with(
                'success',
                'Certificate frame updated successfully.'
            );
    }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         // Basic
    //         'category'   => 'required|string|max:255',
    //         'frame_name' => 'required|string|max:255',

    //         // Images
    //         'background'  => 'nullable|image|max:5120',
    //         'border_image' => 'nullable|image|max:5120',
    //         'watermark'   => 'nullable|image|max:5120',
    //         'logo'        => 'nullable|image|max:5120',
    //         'seal'        => 'nullable|image|max:5120',

    //         // Colors
    //         'primary_color'   => 'nullable|string',
    //         'secondary_color' => 'nullable|string',
    //         'accent_color'    => 'nullable|string',
    //     ]);

    //     $data = $request->except([
    //         '_token'
    //     ]);

    //     /*
    //     |--------------------------------------------------------------------------
    //     | Upload certificate images to Backblaze B2
    //     |--------------------------------------------------------------------------
    //     */

    //     $images = [
    //         'background',
    //         'border_image',
    //         'watermark',
    //         'logo',
    //         'seal'
    //     ];

    //     foreach ($images as $image) {

    //         if ($request->hasFile($image)) {

    //             $file = $request->file($image);

    //             $data[$image] = $file->store(
    //                 'certificate_frames',
    //                 'b2'
    //             );
    //         }
    //     }

    //     /*
    //     |--------------------------------------------------------------------------
    //     | Boolean fields
    //     |--------------------------------------------------------------------------
    //     */

    //     $booleanFields = [
    //         'active'
    //     ];

    //     foreach ($booleanFields as $field) {
    //         $data[$field] = $request->has($field);
    //     }

    //     /*
    //     |--------------------------------------------------------------------------
    //     | Create Certificate Frame
    //     |--------------------------------------------------------------------------
    //     */

    //     CertificateFrame::create($data);

    //     return redirect()
    //         ->route('admin.certificate.frames.index')
    //         ->with(
    //             'success',
    //             'Certificate Frame Created Successfully'
    //         );
    // }
    public function show(CertificateFrame $certificateFrame)
    {
        return view(
            'admin.certificate.show',
            compact('certificateFrame')
        );
    }
    public function certificateImage($filename)
    {
        $path = 'certificate_frames/' . $filename;

        if (!Storage::disk('b2')->exists($path)) {
            abort(404);
        }

        $file = Storage::disk('b2')->get($path);

        $extension = strtolower(
            pathinfo($filename, PATHINFO_EXTENSION)
        );

        $mimeTypes = [
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
            'gif'  => 'image/gif',
            'webp' => 'image/webp',
        ];

        $mime = $mimeTypes[$extension] ?? 'application/octet-stream';

        return response($file)
            ->header('Content-Type', $mime)
            ->header('Cache-Control', 'private, max-age=3600');
    }

    public function edit(CertificateFrame $certificateFrame)
    {
        return view(
            'admin.certificate.edit',
            compact('certificateFrame')
        );
    }


    // public function update(Request $request, CertificateFrame $certificateFrame)
    // {
    //     $request->validate([
    //         'category'        => 'required|string|max:255',
    //         'frame_name'      => 'required|string|max:255',

    //         'background'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
    //         'border_image'    => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
    //         'watermark'       => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
    //         'logo'            => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
    //         'seal'            => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',

    //         'primary_color'   => 'required|string|max:20',
    //         'secondary_color' => 'required|string|max:20',
    //         'accent_color'    => 'required|string|max:20',

    //         'active'          => 'nullable|boolean',
    //     ]);

    //     $data = [
    //         'category'        => $request->input('category'),
    //         'frame_name'      => $request->input('frame_name'),
    //         'primary_color'   => $request->input('primary_color'),
    //         'secondary_color' => $request->input('secondary_color'),
    //         'accent_color'    => $request->input('accent_color'),
    //         'active'          => $request->boolean('active'),
    //     ];

    //     $oldFiles = [];

    //     $images = [
    //         'background'   => 'certificate_frames/backgrounds',
    //         'border_image' => 'certificate_frames/borders',
    //         'watermark'    => 'certificate_frames/watermarks',
    //         'logo'         => 'certificate_frames/logos',
    //         'seal'         => 'certificate_frames/seals',
    //     ];

    //     foreach ($images as $field => $folder) {

    //         if ($request->hasFile($field)) {

    //             /*
    //              * Save old path first
    //              */
    //             if (!empty($certificateFrame->$field)) {
    //                 $oldFiles[$field] = $certificateFrame->$field;
    //             }

    //             /*
    //              * Upload NEW file to B2
    //              */
    //             $newPath = $request
    //                 ->file($field)
    //                 ->store($folder, 'b2');

    //             /*
    //              * If upload failed
    //              */
    //             if (!$newPath) {
    //                 return back()
    //                     ->withInput()
    //                     ->with(
    //                         'error',
    //                         "Failed to upload {$field} to B2."
    //                     );
    //             }

    //             /*
    //              * Save new path
    //              */
    //             $data[$field] = $newPath;
    //         }
    //     }

    //     /*
    //      * Update database
    //      */
    //     $certificateFrame->update($data);

    //     /*
    //      * Delete OLD files from B2
    //      */
    //     foreach ($oldFiles as $oldPath) {

    //         try {
    //             if (
    //                 !empty($oldPath) &&
    //                 Storage::disk('b2')->exists($oldPath)
    //             ) {
    //                 Storage::disk('b2')->delete($oldPath);
    //             }
    //         } catch (\Throwable $e) {

    //             Log::warning(
    //                 'Old certificate frame image could not be deleted from B2',
    //                 [
    //                     'path' => $oldPath,
    //                     'error' => $e->getMessage(),
    //                 ]
    //             );
    //         }
    //     }

    //     return redirect()
    //         ->route('admin.certificate.frames.index')
    //         ->with(
    //             'success',
    //             'Certificate frame updated successfully.'
    //         );
    // }







    //instructor
    public function ins_create(Course $course)
    {
        abort_if($course->instructor_id != Auth::id(), 403);

        $learners = CourseOrder::with('user')
            ->where('course_id', $course->id)
            ->where('status', 'paid')
            ->where('percentage', '>=', 75)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('certificates')
                    ->whereColumn('certificates.user_id', 'course_orders.user_id')
                    ->whereColumn('certificates.course_id', 'course_orders.course_id');
            })
            ->get();

        $frames = CertificateFrame::where('active', 1)->get();

        return view(
            'instructor.certificate.create',
            compact('course', 'learners', 'frames')
        );
    }

    public function ins_store(Request $request, Course $course)
    {
        abort_if(
            $course->instructor_id != auth()->id(),
            403
        );

        $validated = $request->validate([
            'user_id' => [
                'required',
                'exists:users,id'
            ],

            'certificate_frame_id' => [
                'required',
                'exists:certificate_frames,id'
            ],

            'description' => [
                'nullable',
                'string',
                'max:100'
            ],

            'signature' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ]
        ]);

        /*
    |--------------------------------------------------------------------------
    | Check learner belongs to course
    |--------------------------------------------------------------------------
    */

        $enrolled = CourseOrder::where(
            'course_id',
            $course->id
        )
            ->where(
                'user_id',
                $request->user_id
            )
            ->where(
                'status',
                'paid'
            )
            ->exists();

        if (!$enrolled) {

            return back()
                ->with(
                    'error',
                    'Learner is not enrolled in this course.'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | Prevent Duplicate Certificate
    |--------------------------------------------------------------------------
    */

        $exists = Certificate::where(
            'course_id',
            $course->id
        )
            ->where(
                'user_id',
                $request->user_id
            )
            ->exists();

        if ($exists) {

            return back()
                ->with(
                    'error',
                    'Certificate already issued.'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | Generate Certificate ID
    |--------------------------------------------------------------------------
    */

        $certificateId =
            'CERT-'
            . date('Y')
            . '-'
            . strtoupper(
                Str::random(8)
            );

        /*
    |--------------------------------------------------------------------------
    | Verification Hash
    |--------------------------------------------------------------------------
    */

        $hash = hash(
            'sha256',
            $certificateId . time()
        );

        /*
    |--------------------------------------------------------------------------
    | Verification URL
    |--------------------------------------------------------------------------
    */

        $verifyUrl = route(
            'certificate.verify',
            $hash
        );

        /*
    |--------------------------------------------------------------------------
    | Generate QR Code
    | Store QR in Private B2
    |--------------------------------------------------------------------------
    */

        $qrPath =
            'certificates/qrcode/'
            . $certificateId
            . '.svg';

        $qrContent = QrCode::size(300)
            ->generate($verifyUrl);

        Storage::disk('b2')->put(
            $qrPath,
            $qrContent
        );

        /*
    |--------------------------------------------------------------------------
    | Upload Instructor Signature to Private B2
    |--------------------------------------------------------------------------
    */

        $signaturePath = null;

        if ($request->hasFile('signature')) {

            $signaturePath = $request
                ->file('signature')
                ->store(
                    'certificates/signatures',
                    'b2'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | Create Certificate
    |--------------------------------------------------------------------------
    */

        Certificate::create([

            'user_id' => $request->user_id,

            'course_id' => $course->id,

            'instructor_id' => Auth::id(),

            'certificate_frame_id' =>
            $request->certificate_frame_id,

            'certificate_id' =>
            $certificateId,

            'verification_hash' =>
            $hash,

            'qr_code' =>
            $qrPath,

            'description' =>
            $request->description,

            'signature' =>
            $signaturePath,

            'status' =>
            'valid',

            'issued_at' =>
            now(),
        ]);

        return redirect()
            ->route(
                'instructor.certificates.index',
                $course->id
            )
            ->with(
                'success',
                'Certificate issued successfully.'
            );
    }
    // public function ins_store(Request $request, Course $course)
    // {



    //     abort_if(
    //         $course->instructor_id != auth()->id(),
    //         403
    //     );

    //     $validated = $request->validate([
    //         'user_id' => [
    //             'required',
    //             'exists:users,id'
    //         ],
    //         'certificate_frame_id' => [
    //             'required',
    //             'exists:certificate_frames,id'
    //         ],
    //         'description' => [
    //             'nullable',
    //             'string',
    //             'max:100'
    //         ],
    //         'signature' => [
    //             'nullable',
    //             'image',
    //             'max:2048'
    //         ]
    //     ]);

    //     // Check learner belongs to course
    //     $enrolled =
    //         CourseOrder::where(
    //             'course_id',
    //             $course->id
    //         )
    //         ->where(
    //             'user_id',
    //             $request->user_id
    //         )
    //         ->where(
    //             'status',
    //             'paid'
    //         )
    //         ->exists();

    //     if (!$enrolled) {

    //         return back()
    //             ->with(
    //                 'error',
    //                 'Learner is not enrolled in this course.'
    //             );
    //     }


    //     // prevent Duplicate Certificate
    //     $exists =
    //         Certificate::where(
    //             'course_id',
    //             $course->id
    //         )
    //         ->where(
    //             'user_id',
    //             $request->user_id
    //         )
    //         ->exists();
    //     if ($exists) {
    //         return back()
    //             ->with(
    //                 'error',
    //                 'Certificate already issued.'
    //             );
    //     }

    //     // Generate Certificate ID
    //     $certificateId =
    //         'CERT-'
    //         . date('Y')
    //         . '-'
    //         . strtoupper(
    //             Str::random(8)
    //         );

    //     //  Verification Hash
    //     $hash =
    //         hash(
    //             'sha256',
    //             $certificateId
    //                 . time()
    //         );

    //     // Generate QR
    //     $verifyUrl =
    //         route(
    //             'certificate.verify',
    //             $hash
    //         );
    //     $qrPath =
    //         'certificates/qrcode/'
    //         . $certificateId
    //         . '.svg';

    //     Storage::put(
    //         $qrPath,
    //         QrCode::size(300)
    //             ->generate($verifyUrl)
    //     );

    //     // Upload Instructor Signature
    //     $signaturePath = null;

    //     if ($request->hasFile('signature')) {
    //         $signaturePath =
    //             $request
    //             ->file('signature')
    //             ->store(
    //                 'certificates/signatures',
    //                 'public'
    //             );
    //     }

    //     Certificate::create([

    //         'user_id' => $request->user_id,
    //         'course_id' => $course->id,
    //         'instructor_id' => Auth::id(),
    //         'certificate_frame_id' => $request->certificate_frame_id,
    //         'certificate_id' => $certificateId,
    //         'verification_hash' => $hash,
    //         'qr_code' => $qrPath,
    //         'description' => $request->description,
    //         'signature' => $signaturePath,
    //         'status' => 'valid',
    //         'issued_at' => now(),
    //     ]);

    //     return redirect()
    //         ->route(
    //             'instructor.certificates.index',
    //             $course->id
    //         )
    //         ->with(
    //             'success',
    //             'Certificate issued successfully.'
    //         );
    // }


    public function ins_index($courseId)
    {
        $course = Course::where('id', $courseId)
            ->where('instructor_id', Auth::id())
            ->firstOrFail();
        $awarded = CourseOrder::with('user')
            ->where('course_id', $course->id)
            ->where('status', 'paid')
            ->where('percentage', '>=', 75)
            ->latest()
            ->paginate(10, ['*'], 'awarded');

        $notAwarded = CourseOrder::with('user')
            ->where('course_id', $course->id)
            ->where('status', 'paid')
            ->where('percentage', '<', 75)
            ->latest()
            ->paginate(10, ['*'], 'pending');
        $certificates = Certificate::with([
            'user',
            'frame'
        ])
            ->where('course_id', $course->id)
            ->where('instructor_id', Auth::id())
            ->latest()
            ->paginate(12);

        return view(
            'instructor.certificate.index',
            compact(
                'course',
                'certificates',
                'awarded',
                'notAwarded'
            )
        );
    }

    public function certificate_show(Certificate $certificate)
    {
        // abort_if(
        //     $certificate->instructor_id != Auth::id(),
        //     403
        // );

        $course = Course::find($certificate->course_id);

        $certificate->load([
            'user',
            'course',
            'frame',
            'instructor'
        ]);

        return view(
            'instructor.certificate.show',
            compact(
                'certificate',
                'course'
            )
        );
    }
    public function certificateFile(
        Certificate $certificate,
        string $type
    ) {
        switch ($type) {

            case 'background':
                $path = $certificate->frame?->background;
                break;

            case 'border':
                $path = $certificate->frame?->border_image;
                break;

            case 'watermark':
                $path = $certificate->frame?->watermark;
                break;

            case 'logo':
                $path = $certificate->frame?->logo;
                break;

            case 'seal':
                $path = $certificate->frame?->seal;
                break;

            case 'signature':
                $path = $certificate->signature;
                break;

            case 'qr':
                $path = $certificate->qr_code;
                break;

            default:
                abort(404);
        }

        if (!$path) {
            abort(404);
        }

        if (!Storage::disk('b2')->exists($path)) {
            abort(404);
        }

        $file = Storage::disk('b2')->get($path);

        $extension = strtolower(
            pathinfo($path, PATHINFO_EXTENSION)
        );

        $mimeTypes = [
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
            'webp' => 'image/webp',
            'gif'  => 'image/gif',
            'svg'  => 'image/svg+xml',
        ];

        $mime = $mimeTypes[$extension]
            ?? 'application/octet-stream';

        return response($file)
            ->header('Content-Type', $mime)
            ->header(
                'Cache-Control',
                'private, max-age=3600'
            );
    }
    // public function certificate_show(Certificate $certificate)
    // {
    //     // abort_if(
    //     //     $certificate->instructor_id
    //     //         != Auth::id(),
    //     //     403
    //     // );
    //     $course = Course::find($certificate->course_id);
    //     $certificate->load([
    //         'user',
    //         'course',
    //         'frame',
    //         'instructor'
    //     ]);
    //     return view(
    //         'instructor.certificate.show',
    //         compact(
    //             'certificate',
    //             'course'
    //         )
    //     );
    // }
    public function downloadPdf(Certificate $certificate)
    {
        // abort_if(
        //     $certificate->instructor_id
        //         != Auth::id(),
        //     403
        // );
        $certificate->load([
            'user',
            'course',
            'frame',
            'instructor'
        ]);
        $pdf = Pdf::loadView(
            'instructor.certificate.pdf',
            compact(
                'certificate'
            )
        )
            ->setPaper(
                'a4',
                'landscape'
            );
        return $pdf->download(
            $certificate->certificate_id
                . '.pdf'
        );
    }

    //learner
    public function myCertificate(Course $course) //learner show certificate
    {
        $certificate = Certificate::where('course_id', $course->id)
            ->where('user_id', auth()->id())
            ->first();

        if (!$certificate) {
            // return view('learner.certificates.not-found', compact('course'));
            return view('learner.certificates', compact('course'));
        }

        return $this->certificate_show($certificate);
    }
}
