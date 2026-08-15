<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;

class CertificateFrame extends Model
{
    use HasFactory;

    protected $fillable = [

        'category',
        'frame_name',
        'background',
        'border_image',
        'watermark',
        'logo',
        'seal',
        'primary_color',
        'secondary_color',
        'accent_color',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function getBackgroundUrlAttribute()
    {
        return $this->b2Url(
            $this->background
        );
    }


    public function getBorderImageUrlAttribute()
    {
        return $this->b2Url(
            $this->border_image
        );
    }


    public function getWatermarkUrlAttribute()
    {
        return $this->b2Url(
            $this->watermark
        );
    }


    public function getLogoUrlAttribute()
    {
        return $this->b2Url(
            $this->logo
        );
    }


    public function getSealUrlAttribute()
    {
        return $this->b2Url(
            $this->seal
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Generate temporary B2 URL
    |--------------------------------------------------------------------------
    */

    protected function b2Url($path)
    {
        if (empty($path)) {
            return null;
        }

        try {

            $disk = Storage::disk('b2');

            if (!$disk->exists($path)) {
                return null;
            }
            /** @var FilesystemAdapter $disk */

            return $disk->temporaryUrl(
                $path,
                now()->addHours(2)
            );
        } catch (\Throwable $e) {

            // \Log::error(
            //     'Certificate B2 URL error',
            //     [
            //         'path' =>
            //         $path,

            //         'error' =>
            //         $e->getMessage(),
            //     ]
            // );

            return null;
        }
    }
}
