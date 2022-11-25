<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DropzoneController extends Controller
{
    public function index()
    {
        $data = $this->scan_dir('img');

        return response()->json([
            'success' => true,
            'files' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $file = $request->file('file');

        $fileName = $file->getClientOriginalName();

        $name = pathinfo($fileName, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();

        if (File::exists('img/' . $file->getClientOriginalName())) {
            $fileName = $name.'-'.Str::random(3).'.'.$extension ;
        }


        $file->move(public_path('img'), $fileName);


        return response()->json([
            'success' => true,
            'message' => 'File berhasil diupload!',
        ]);
    }


    public function destroy($file)
    {
        if (File::exists('img/' . $file)) {
            File::delete('img/' . $file);
        }
        return response()->json([
            'success' => true,
            'message' => 'File berhasil dihapus!',
        ]);
    }


    protected function scan_dir($dir)
    {
        $ignored = array('.', '..', '.svn', '.htaccess'); // -- ignore these file names
        $files = array(); //----------------------------------- create an empty files array to play with
        foreach (scandir($dir) as $file) {
            if ($file[0] === '.') continue; //----------------- ignores all files starting with '.'
            if (in_array($file, $ignored)) continue; //-------- ignores all files given in $ignored
            $files[$file] = filemtime($dir . '/' . $file); //-- add to files list
        }
        arsort($files); //------------------------------------- sort file values (creation timestamps)
        $files = array_keys($files); //------------------------ get all files after sorting
        return ($files) ? $files : false;
    }
}
