<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index($folderName = '')
    {
        $files = \Storage::disk('public')->files($folderName);
        $directories = \Storage::disk('public')->directories($folderName);
        
        return view('course.index', compact('files', 'directories', 'folderName'));
    }
}
