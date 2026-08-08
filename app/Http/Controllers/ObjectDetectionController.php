<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ObjectDetectionService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ObjectDetectionController extends Controller
{
    protected $service;

    public function __construct(
        ObjectDetectionService $service
    ) {
        $this->service = $service;
    }

    public function index()
    {
        return view(
            'object-detection.index'
        );
    }
    public function html()
    {
        return view('object-detection.html');
    }
    public function css()
    {
        return view('object-detection.css');
    }
    public function js()
    {
        return view('object-detection.js');
    }
    public function tailwind()
    {
        return view('object-detection.tailwind');
    }

    public function detect(
        Request $request
    ) {
        $request->validate([

            'image' => [
                'required',
                'image',
                'max:10240'

            ]

        ]);

        try {

            $result =
                $this->service
                ->detect(
                    $request
                        ->file('image')
                );

            return view(
                'object-detection.index',
                compact('result')
            );
        } catch (\Exception $e) {

            return back()

                ->withErrors([

                    'error' => $e->getMessage()

                ]);
        }
    }

    // public function restore(Request $request)
    // {
    //     $apiUrl = env('CV_SERVICE_URL');
    //     $request->validate([
    //         'image' => 'required|image'
    //     ]);

    //     $response = Http::attach(
    //         'file',
    //         file_get_contents($request->file('image')),
    //         $request->file('image')->getClientOriginalName()
    //     )->post($apiUrl . '/restore-image');

    //     return response()->json($response->json());
    // }


    public function colorize(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);
        $apiUrl = env('CV_SERVICE_URL');
        $response = Http::timeout(120)
            ->attach(
                'file',
                file_get_contents($request->file('image')->getRealPath()),
                $request->file('image')->getClientOriginalName()
            )
            ->post($apiUrl . '/colorize');

        return response()->json($response->json());
    }
    public function process(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'type' => 'required'
        ]);

        $types = [
            'negative',
            'log',
            'power-law',
            'histogram-equalization'
        ];

        if (!in_array($request->type, $types)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Type'
            ]);
        }


        $response = Http::attach(
            'file',
            fopen(
                $request->file('image')->getRealPath(),
                'r'
            ),
            $request->file('image')->getClientOriginalName()

        )->post(
            "http://127.0.0.1:8001/" . $request->type

        );


        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Python Error'
            ]);
        }

        $input =
            $request->file('image')
            ->store('inputs', 'public');
        $file =
            $request->type . '_' . time() . '.png';
        Storage::disk('public')->put(
            'outputs/' . $file,
            $response->body()
        );

        return response()->json([
            'success' => true,
            'message' => 'Transformation Completed',
            'input' => asset(
                'storage/' . $input
            ),
            'output' => asset(
                'storage/outputs/' . $file
            )
        ]);
    }
    public function restore_process(Request $request)
    {

        $apiUrl = env('CV_SERVICE_URL');

        $request->validate([

            'image' => 'required|image'

        ]);




        $response = Http::attach(

            'file',

            fopen(
                $request->file('image')->getRealPath(),
                'r'
            ),

            $request->file('image')->getClientOriginalName()


        )->post($apiUrl . '/restore_restoration');


        if (!$response->successful()) {

            return response()->json([

                'success' => false,

                'message' => 'Python Error'

            ]);
        }
        $input =
            $request->file('image')
            ->store(
                'inputs',
                'public'
            );

        $name =
            'restored_' . time() . '.png';


        Storage::disk('public')
            ->put(

                'outputs/' . $name,

                $response->body()

            );


        return response()->json([
            'success' => true,
            'message' =>
            'Image Restored Successfully',

            'input' =>
            asset(
                'storage/' . $input
            ),



            'output' =>
            asset(
                'storage/outputs/' . $name
            )


        ]);
    }
}
