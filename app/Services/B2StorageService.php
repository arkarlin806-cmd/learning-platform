<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class B2StorageService
{
    protected function config(): array
    {
        return config('services.b2');
    }

    /**
     * Authorize Backblaze B2 account
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

        $data = $response->json();

        if (
            empty($data['authorizationToken']) ||
            empty($data['apiInfo']['storageApi']['apiUrl'])
        ) {
            throw new RuntimeException(
                'B2 authorization response is missing apiUrl or authorizationToken: '
                    . $response->body()
            );
        }

        return $data;
    }

    /**
     * Get upload URL
     */
    protected function getUploadUrl(array $authorization): array
    {
        $config = $this->config();

        $apiUrl = $authorization['apiInfo']['storageApi']['apiUrl'];

        $response = Http::withHeaders([
            'Authorization' => $authorization['authorizationToken'],
            'Content-Type' => 'application/json',
        ])
            ->timeout(30)
            ->post(
                $apiUrl . '/b2api/v4/b2_get_upload_url',
                [
                    'bucketId' => $config['bucket_id'],
                ]
            );

        if ($response->failed()) {
            throw new RuntimeException(
                'B2 get upload URL failed: ' . $response->body()
            );
        }

        $data = $response->json();

        if (
            empty($data['uploadUrl']) ||
            empty($data['authorizationToken'])
        ) {
            throw new RuntimeException(
                'B2 upload URL response is invalid: '
                    . $response->body()
            );
        }

        return $data;
    }

    /**
     * Upload file to Backblaze B2
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

        $mimeType = $file->getMimeType()
            ?: 'application/octet-stream';

        $sha1 = sha1($contents);

        $response = Http::withHeaders([
            'Authorization' => $upload['authorizationToken'],
            'X-Bz-File-Name' => rawurlencode($fileName),
            'Content-Type' => $mimeType,
            'X-Bz-Content-Sha1' => $sha1,
            'Content-Length' => strlen($contents),
        ])
            ->withBody(
                $contents,
                $mimeType
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

    public function getDownloadUrl(
        string $fileName,
        int $validSeconds = 3600
    ): string {
        $authorization = $this->authorize();

        $config = $this->config();

        $apiUrl = $authorization['apiInfo']['storageApi']['apiUrl'];

        $response = Http::withHeaders([
            'Authorization' => $authorization['authorizationToken'],
            'Content-Type' => 'application/json',
        ])
            ->timeout(30)
            ->post(
                $apiUrl . '/b2api/v4/b2_get_download_authorization',
                [
                    'bucketId' => $config['bucket_id'],
                    'fileNamePrefix' => $fileName,
                    'validDurationInSeconds' => $validSeconds,
                ]
            );

        if ($response->failed()) {
            throw new RuntimeException(
                'B2 download authorization failed: ' . $response->body()
            );
        }

        $data = $response->json();

        if (empty($data['authorizationToken'])) {
            throw new RuntimeException(
                'B2 download authorization token missing: '
                    . $response->body()
            );
        }

        /*
        |--------------------------------------------------------------------------
        | IMPORTANT
        |--------------------------------------------------------------------------
        | Backblaze B2 v4:
        | apiInfo.storageApi.downloadUrl
        |--------------------------------------------------------------------------
        */

        $downloadUrl = $authorization['apiInfo']['storageApi']['downloadUrl'];

        $encodedFileName = str_replace(
            '%2F',
            '/',
            rawurlencode($fileName)
        );

        return rtrim($downloadUrl, '/')
            . '/file/'
            . $config['bucket_name']
            . '/'
            . $encodedFileName
            . '?Authorization='
            . urlencode($data['authorizationToken']);
    }
}
