<?php

namespace App\Services\Uploader;

use App\Exceptions\UploadException;
use Illuminate\Http\UploadedFile;


class UploadService
{
    public function chirpAttachment(UploadedFile $file): File
    {
        if (!$file->store('chirps')) {
            throw new UploadException('Failed to upload the file.');
        }

        $name = $file->hashName();

        return new File(
            name: "{$name}",
            originalName: $file->getClientOriginalName(),
            mime: $file->getClientMimeType(),
            path: "chirps/{$name}",
            disk: config('filesystems.default'),
            size: $file->getSize(),
        );
    }
}
