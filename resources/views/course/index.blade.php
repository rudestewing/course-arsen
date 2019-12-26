@extends('layouts.app')

@section('content')
    <div class="container">
        <table>
            @foreach ($courses as $item)
                <tr>
                    <td> 
                        <a href="{{route('course.show', $item)}}"> {{$item}} </a>    
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection