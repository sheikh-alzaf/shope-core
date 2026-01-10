<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait MediaUpload
{
    private $default_disk;

    public function __construct()
    {
        $this->default_disk = config('shope-core.filesystems.default');
    }

    public function uploadImage($file, $filePath, $file_name = null, $is_original_extension = false)
    {
        if (is_string($file)) {
            return $this->uploadBase64File($file, $filePath, $file_name, $is_original_extension);
        } else {
            return $this->uploadFileObject($file, $filePath, $file_name, $is_original_extension);
        }
    }

    public function uploadBase64File($image, $filePath, $file_name = null, $is_original_extension = false)
    {

        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        $file_extension = $is_original_extension ? $this->getExtension($image) : '.' . config('shope-core.filesystems.default_image_format');
        $file_name = ($file_name ? $file_name : uniqid()) . $file_extension;

        $file_path = $filePath . '/' . $file_name;

        Storage::disk($this->default_disk)->put($file_path, base64_decode($image), 'public');

        return $file_path;
    }

    public function getExtension($image)
    {
        $decoded_image = base64_decode($image);

        $finfo = finfo_open();
        $mime_type = finfo_buffer($finfo, $decoded_image, FILEINFO_MIME_TYPE);
        finfo_close($finfo);

        $extensions = [
            'image/jpeg' => '.jpg',
            'image/png' => '.png',
            'image/svg+xml' => '.svg',
            'image/webp' => '.webp',
            'audio/mp4' => '.mp4',
            'video/mp4' => '.mp4',
            'video/mkv' => '.mkv',
        ];

        return $extensions[$mime_type] ?? '.' . config('shope-core.filesystems.default_image_format');
    }

    public function uploadFileObject($file, $filePath, $file_name = null, $is_original_extension = false)
    {
        $file_extension = $is_original_extension ? $file->getClientOriginalExtension() : config('shope-core.filesystems.default_image_format');
        $file_name = ($file_name ? $file_name : uniqid()) . '.' . $file_extension;

        return Storage::disk($this->default_disk)->putFileAs($filePath, $file, $file_name, 'public');
    }

    public function multipleImageUpload($files, $filePath)
    {
        $images = [];
        if (! $files) {
            return [];
        }
        foreach ($files as $key => $file) {
            $file_name = uniqid() . '.' . $file->getClientOriginalExtension();

            Storage::disk($this->default_disk)->putFileAs($filePath, $file, $file_name, 'public');

            $images[] = $filePath . '/' . $file_name;
        }

        return $images;
    }

    public function multipleVideoUpload($files, $filePath)
    {
        $videos = [];
        if (! $files) {
            return [];
        }
        foreach ($files as $key => $file) {
            $file_name = uniqid() . '.' . $file->getClientOriginalExtension();

            Storage::disk($this->default_disk)->putFileAs($filePath, $file, $file_name, 'public');

            $videos[] = $filePath . '/' . $file_name;
        }

        return $videos;
    }

    public function deleteImage($imagePath)
    {
        if ($imagePath && Storage::disk($this->default_disk)->exists($imagePath)) {
            Storage::disk($this->default_disk)->delete($imagePath);
        }
    }

    public function deleteImages(array $images)
    {
        foreach ($images as $image) {
            $this->deleteImage($image);
        }
    }
}
