<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function access($path)
    {
        $file = \Storage::disk('local')->get($path);
        $mime = \Storage::disk('local')->mimeType($path);
        return response($file)->header('Content-Type', $mime);
    }

    public function download($path)
    {
        return \Storage::disk('local')->download($path);
    }
}
