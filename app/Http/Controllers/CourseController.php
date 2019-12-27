<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index($folderName = '')
    {
        $files = (\Storage::disk('local')->files($folderName));
        $directories = \Storage::disk('local')->directories($folderName);
        
        $files = count($files) ? collect($files)->map(function($item) {
            return (object) [
                'string' => $item,
                'size' => $this->convertFilesize(\Storage::disk('local')->size($item), 2),
                'lastModified' => \Storage::disk('local')->lastModified($item)
            ];
        }) : [];

        $directories = count($directories) ? collect($directories)->map(function($item) {
            return (object) [
                'string' => $item,
                'size' => $this->convertFilesize($this->countSizeInsideDir($item), 2),
                // 'totalFiles' => count(\Storage::disk('local')->files($item)),
                // 'totalDirs' => count(\Storage::disk('local')->directories($item)),
                'lastModified' => \Storage::disk('local')->lastModified($item)
            ];
        }) : [];

        $paths = $folderName != '' ? $this->generatePaths($folderName) : [];

        return view('course.index', compact('files', 'directories', 'folderName', 'paths'));
    }

    public function show($string)
    {
        $mime = $mime = \Storage::disk('local')->mimeType($string);
        return view('course.show', compact('string', 'mime'));
    }

    private function generatePaths($string): array
    {
        $paths = [];
        
        $exploded = explode('/', $string);
        $count = count($exploded);
   
        for($i = 0; $i < $count+1; $i++) {
            $newArray = [];
            for ($j=0; $j < $i; $j++) { 
                $newArray[] = $exploded[$j];
            }

            $newArray = array_filter($newArray);
            $paths[] = (object) [
                'path' => implode('/', $newArray),
                'name' => count($newArray) > 0 ? $newArray[count($newArray)-1] : 'home'
            ];
        }

        return $paths;
    }

    private function asdf($array, $num) 
    {
        $newArray = [];
        for ($i=0; $i < $num; $i++) { 
            $newArray[] = $array[$i];
        }

        return $newArray;

    }

    private function countSizeInsideDir($dir)
    {
        $size = 0;
        foreach(\Storage::disk('local')->allFiles($dir) as $item) {
            $size += \Storage::disk('local')->size($item);
        }
        return $size;
    }

    private function convertFilesize($bytes, $decimals = 2){
        $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .' '.@$size[$factor];
    }
}
