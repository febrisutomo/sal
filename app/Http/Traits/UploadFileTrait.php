<?php

namespace App\Http\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

trait UploadFileTrait{
    public function uploadFile($file, $path = 'img/')
    {
        $fileName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        if (File::exists($path . $file->getClientOriginalName())) {
            $fileName = pathinfo($fileName, PATHINFO_FILENAME) . '-' . Str::random(3) . '.' . $extension;
        }

        $file->move(public_path($path), $fileName);

        return $fileName;
    }

    public function deleteFile($file, $path = 'img/'){
        if (File::exists($path.$file)) {
            File::delete($path.$file);
        }
    }
}