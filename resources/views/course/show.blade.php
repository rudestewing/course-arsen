@extends('layouts.app')

@section('content')
    <div class="container">
        <table>
            @foreach ($files as $item)
                <tr>
                    <td> 
                        <a target="_blank" href="{{asset('storage/'.$item)}}"> {{$item}} </a>    
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection