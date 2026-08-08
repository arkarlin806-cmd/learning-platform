<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ObjectDetectionService
{
    public function detect(UploadedFile $file): array
    {
        $response = Http::timeout(
            env('CV_TIMEOUT', 120)
        )
            ->attach(
                'file',
                file_get_contents(
                    $file->getRealPath()
                ),
                $file->getClientOriginalName()
            )
            ->post(
                env('CV_SERVICE_URL') . '/detect'
            );

        if ($response->failed()) {
            throw new \Exception(
                $response->body()
            );
        }

        return $response->json();
    }

    public function restore(Request $request)
    {
        $cvServer = env('CV_SERVICE_URL');
        $request->validate([
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,bmp,webp',
                'max:10240'
            ]
        ]);

        try {

            $response = Http::timeout(120)
                ->attach(
                    'file',
                    file_get_contents($request->file('image')->getRealPath()),
                    $request->file('image')->getClientOriginalName()
                )
                ->post($cvServer . '/restore-image');

            if (!$response->successful()) {

                return response()->json([
                    'status' => 'error',
                    'message' => 'CV Server Error'
                ], 500);
            }

            return response()->json(
                $response->json()
            );
        } catch (\Exception $e) {

            return response()->json([

                'status' => 'error',

                'message' => $e->getMessage()

            ], 500);
        }
    }
}
