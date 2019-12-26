@extends('layouts.app')

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
        <table class="datatable-client-side">
            <thead>
                <th> Name </th>
            </thead>
            @foreach ($directories as $dir)
                <tr>
                    <td> 
                        <a href="{{route('course.index', ['folderName' => $dir])}}"> <i class="far fa-folder"></i>  {{$dir}} </a>    
                    </td>
                </tr>
            @endforeach
            @foreach ($files as $file)
                <tr>
                    <td> 
                        <a target="_blank" href="{{asset('storage/'.$file)}}"> <i class="fas fa-file"></i> {{ $folderName != '' ? optional(explode($folderName.'/', $file))[1] : $file }} </a>    
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection