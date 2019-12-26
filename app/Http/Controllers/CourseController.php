<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index($folderName = '')
    {
        $files = (\Storage::disk('public')->files($folderName));
        $directories = \Storage::disk('public')->directories($folderName);
        
        $files = count($files) ? collect($files)->map(function($item) {
            return (object) [
                'string' => $item,
                'size' => $this->convertFilesize(\Storage::disk('public')->size($item), 2)
            ];
        }) : [];

        $directories = count($directories) ? collect($directories)->map(function($item) {
            return (object) [
                'string' => $item,
                'size' => $this->convertFilesize($this->countSizeInsideDir($item), 2),
            ];
        }) : [];

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

    private function countSizeInsideDir($dir)
    {
        $size = 0;
        foreach(\Storage::disk('public')->allFiles($dir) as $item) {
            $size += \Storage::disk('public')->size($item);
        }
        return $size;
    }

    private function convertFilesize($bytes, $decimals = 2){
        $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .' '.@$size[$factor];
    }
}
