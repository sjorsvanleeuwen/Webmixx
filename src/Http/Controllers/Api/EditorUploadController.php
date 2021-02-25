<?php

declare(strict_types=1);

namespace SjorsvanLeeuwen\Webmixx\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use SjorsvanLeeuwen\Webmixx\Http\Controllers\BaseController;
use SjorsvanLeeuwen\Webmixx\Http\Requests\EditorUploadRequest;
use SjorsvanLeeuwen\Webmixx\Webmixx;

class EditorUploadController extends BaseController
{
    protected Webmixx $webmixx;

    public function __construct(Webmixx $webmixx)
    {
        $this->webmixx = $webmixx;
    }

    public function __invoke(EditorUploadRequest $request): JsonResponse
    {
        $file = $request->file('upload');
        $filename = Str::random(32);
        $disk = $this->webmixx->getPublicUploadDisk();
        $path = $disk->putFileAs($this->webmixx->getUploadDirectory(), $file, $filename . '.' . $file->extension());

        return response()->json([
            'url' => asset($path),
        ]);
    }
}
