<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index($folderName = '')
    {
        $files = \Storage::disk('public')->files($folderName);
        $directories = \Storage::disk('public')->directories($folderName);
        

        $exploded = explode('/', $folderName);
        $paths = $this->generatePaths($exploded);

        return view('course.index', compact('files', 'directories', 'folderName', 'paths'));
    }

    private function generatePaths($array): array
    {
        $paths = [];
        $count = count($array) - 1;
        foreach($array as $item) {

            // $dir = ''; 
            // for ($i=$count; $i > $count ; $i--) { 
            //     $dir .= '/'
            // }
            
            $paths[] = [
                'dir' => $count,
                'name' => $item
            ];
            
            $count--;
        }

        return $paths;
    }
}
