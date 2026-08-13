<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class B2StorageService
{
    protected function config(): array
    {
        return config('services.b2');
    }

    /**
     * Authorize B2 account.
     */
    protected function authorize(): array
    {
        $config = $this->config();

        $response = Http::withBasicAuth(
            $config['key_id'],
            $config['application_key']
        )
            ->timeout(30)
            ->get(
                'https://api.backblazeb2.com/b2api/v4/b2_authorize_account'
            );

        if ($response->failed()) {
            throw new RuntimeException(
                'B2 authorization failed: ' . $response->body()
            );
        }

        return $response->json();
    }

    /**
     * Get an upload URL.
     */
    protected function getUploadUrl(array $authorization): array
    {
        $config = $this->config();

        $response = Http::withToken(
            $authorization['authorizationToken']
        )
            ->timeout(30)
            ->post(
                $authorization['apiUrl'] . '/b2api/v4/b2_get_upload_url',
                [
                    'bucketId' => $config['bucket_id'],
                ]
            );

        if ($response->failed()) {
            throw new RuntimeException(
                'B2 get upload URL failed: ' . $response->body()
            );
        }

        return $response->json();
    }

    /**
     * Upload a Laravel UploadedFile.
     */
    public function upload(
        UploadedFile $file,
        string $folder = ''
    ): array {
        $authorization = $this->authorize();

        $upload = $this->getUploadUrl($authorization);

        $originalName = $file->getClientOriginalName();

        $safeName = preg_replace(
            '/[^A-Za-z0-9._-]/',
            '_',
            $originalName
        );

        $filename = uniqid('', true) . '_' . $safeName;

        $fileName = trim(
            $folder . '/' . $filename,
            '/'
        );

        $contents = file_get_contents(
            $file->getRealPath()
        );

        if ($contents === false) {
            throw new RuntimeException(
                'Unable to read uploaded file.'
            );
        }

        $sha1 = sha1($contents);

        $response = Http::withHeaders([
            'Authorization' => $upload['authorizationToken'],

            'X-Bz-File-Name' => rawurlencode($fileName),

            'Content-Type' => $file->getMimeType()
                ?: 'b2/x-auto',

            'X-Bz-Content-Sha1' => $sha1,

            'Content-Length' => strlen($contents),
        ])
            ->withBody(
                $contents,
                $file->getMimeType() ?: 'application/octet-stream'
            )
            ->timeout(300)
            ->post(
                $upload['uploadUrl']
            );

        if ($response->failed()) {
            throw new RuntimeException(
                'B2 upload failed: ' . $response->body()
            );
        }

        $result = $response->json();

        return [
            'file_id' => $result['fileId'],
            'file_name' => $result['fileName'],
            'bucket_id' => $result['bucketId'],
            'size' => $result['contentLength'],
            'sha1' => $result['contentSha1'],
            'content_type' => $result['contentType'],
        ];
    }
}
