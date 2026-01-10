<?php

namespace App\Traits;

trait FormatMediaUrl
{
    private $default_cdn;

    public function __construct()
    {
        parent::__construct();

        $default_disk = config('shope-core.filesystems.default');
        if ($default_disk == 's3') {
            $this->default_cdn = config('shope-core.filesystems.s3.url'). '/' .config('shope-core.filesystems.s3.root');
        } else {
            $this->default_cdn = env('APP_URL') . '/storage/';
        }
    }

    public function formatMediaUrl($media)
    {
        return $media ? $this->default_cdn . $media : $media;
    }

    public function formatMediaUrls($mediaArray)
    {
        if (! $mediaArray) {
            return null;
        }
        $mediaArray = json_decode($mediaArray);
        $formattedMedia = [];
        foreach ($mediaArray as $media) {
            $formattedMedia[] = $this->formatMediaUrl($media);
        }

        return $formattedMedia;
    }

    public function getImagesAttribute($value)
    {
        return $this->formatMediaUrls($value);
    }

    public function getImageAttribute($value)
    {
        return $this->formatMediaUrl($value);
    }

    public function getVideosAttribute($value)
    {
        return $this->formatMediaUrls($value);
    }

    public function getIconAttribute($value)
    {
        return $this->formatMediaUrl($value);
    }

    public function getLogoAttribute($value)
    {
        return $this->formatMediaUrl($value);
    }

    public function getTrademarkImageAttribute($value)
    {
        return $this->formatMediaUrl($value);
    }

    public function getTradeLicenseAttribute($value)
    {
        return $this->formatMediaUrl($value);
    }

    public function getBannerImageAttribute($value)
    {
        return $this->formatMediaUrl($value);
    }

    public function getChequeCopyAttribute($value)
    {
        return $this->formatMediaUrl($value);
    }

    public function getBannerUrlAttribute($value)
    {
        return $this->formatMediaUrl($value);
    }

    public function getNidFrontSideAttribute($value)
    {
        return $this->formatMediaUrl($value);
    }

    public function getNidBackSideAttribute($value)
    {
        return $this->formatMediaUrl($value);
    }
}
