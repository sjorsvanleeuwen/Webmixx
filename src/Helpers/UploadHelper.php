<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Helpers;

use Illuminate\Http\UploadedFile;
use League\Flysystem\AdapterInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class UploadHelper
{
    public static function uploadFile(UploadedFile $uploadedFile, string $directory, string $disk, bool $public = false): string
    {
        $options = [
            'disk' => $disk,
            'visibility' => $public ? AdapterInterface::VISIBILITY_PUBLIC : AdapterInterface::VISIBILITY_PRIVATE,
        ];

        $image_path = $uploadedFile->store($directory, $options);

        if ($image_path === false) {
            throw new UploadException(__(':file could not be stored in directory :directory on disk :disk', [
                'file' => $uploadedFile->getClientOriginalName(),
                'directory' => $directory,
                'disk' => $disk,
            ]));
        }

        return $image_path;
    }

}
