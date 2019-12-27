@extends('layouts.app')


@section('styles')
    <style>
        table a {
            color: inherit;
        }


        ul.breadcumb {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        ul.breadcumb li {
            margin-right: 8px;
        }
        ul.breadcumb li a {
            text-transform: capitalize;
        }
        ul.breadcumb li:after {
            content: '/';
        }
        ul.breadcumb li:last-child:after {
            content: '';
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="mb-2">
           <ul class="breadcumb">
               @foreach ($paths as $item)
                    <li> <a href="{{route('course.index', $item->path)}}"> {{$item->name ?: 'home'}} </a>  </li>
               @endforeach
           </ul>
        </div>
        <table class="table datatable-client-side">
            <thead>
                <th width="80px;"> Modified </th>
                <th> Name </th>
                <th> Size </th>
                <th> Type </th>
            </thead>
            @foreach ($directories as $dir)
                <tr>
                    <td> <small> {{$dir->lastModified}} </small></td>
                    <td> 
                        <a href="{{route('course.index', ['folderName' => $dir->string])}}"> <i class="far fa-folder"></i>  {{ $folderName != '' ? optional(explode($folderName.'/', $dir->string))[1] : $dir->string }} 
                            {{-- <small> ( <i class="far fa-folder"></i> {{$dir->totalDirs}} | <i class="fas fa-file"></i> {{$dir->totalFiles}} ) </small>  --}}
                        </a>    
                    </td>
                    <td> {{$dir->size}} </td>
                    <td> Dir </td>
                </tr>
            @endforeach
            @foreach ($files as $file)
                <tr>
                    <td> <small> {{$file->lastModified}} </small></td>
                    <td> 
                        {{-- <a target="_blank" href="{{asset('storage/'.$file->string)}}"> <i class="fas fa-file"></i> {{ $folderName != '' ? optional(explode($folderName.'/', $file->string))[1] : $file->string }} </a>     --}}
                        {{-- <a target="_blank" href="{{route('storage.access', $file->string)}}"> <i class="fas fa-file"></i> {{ $folderName != '' ? optional(explode($folderName.'/', $file->string))[1] : $file->string }} </a>     --}}
                        <a target="_blank" href="{{route('course.show', $file->string)}}"> <i class="fas fa-file"></i> {{ $folderName != '' ? optional(explode($folderName.'/', $file->string))[1] : $file->string }} </a>    
                    </td>
                    <td> {{$file->size}} </td>
                    <td> File </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection