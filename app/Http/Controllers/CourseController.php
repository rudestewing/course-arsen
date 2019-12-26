<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = \Storage::disk('public')->directories();
        
        return view('course.index', compact('courses'));
    }

    public function show($folderName)
    {
        $files = \Storage::disk('public')->files($folderName);

        return view('course.show', compact('files'));
    }
}
