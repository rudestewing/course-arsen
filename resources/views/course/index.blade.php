@extends('layouts.app')


@section('styles')
    <style>
        table a {
            color: inherit;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="mb-3">
            <a  class="btn btn-sm btn-primary "href="{{route('course.index')}}"> Home </a>
        </div>
        <div>
            @if($folderName != '') 
            <?php $paths = explode('/', $folderName); ?>
            @endif
        </div>
        <table class="table datatable-client-side">
            <thead>
                <th> Name </th>
                <th> Size </th>
                <th> Type </th>
            </thead>
            @foreach ($directories as $dir)
                <tr>
                    <td> 
                        <a href="{{route('course.index', ['folderName' => $dir->string])}}"> <i class="far fa-folder"></i> {{$dir->string}} </a>    
                        {{-- <a href="{{route('course.index', ['folderName' => $dir->string])}}"> <i class="far fa-folder"></i>  {{ $folderName != '' ? optional(explode($folderName.'/', $dir->string))[1] : $dir->string }} </a>     --}}
                    </td>
                    <td> {{$dir->size}} </td>
                    <td> Dir </td>
                </tr>
            @endforeach
            @foreach ($files as $file)
                <tr>
                    <td> 
                        {{-- <a target="_blank" href="{{asset('storage/'.$file->string)}}"> <i class="fas fa-file"></i> {{ $folderName != '' ? optional(explode($folderName.'/', $file->string))[1] : $file->string }} </a>     --}}
                        <a target="_blank" href="{{route('storage.access', $file->string)}}"> <i class="fas fa-file"></i> {{ $folderName != '' ? optional(explode($folderName.'/', $file->string))[1] : $file->string }} </a>    
                    </td>
                    <td> {{$file->size}} </td>
                    <td> File </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection