@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('vendor/videojs/dist/video-js.min.css')}}">
@endsection

@section('content')
    <div class="container">
        <h3> {{$string}} </h3>
        <div style=" display: inline-block; margin 0 auto;">
            <video
                id="my-video"
                class="video-js"
                controls
                preload="auto"
                width="auto"
                height="500"
                data-setup='{ "controls": true, "autoplay": false, "preload": "auto" }'
            >
                <source src="{{route('storage.access', $string)}}" type="{{$mime}}" />
                {{-- <source src="{{asset('sample.mp4')}}" type="video/webm" /> --}}
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that
                {{-- <a href="https://videojs.com/html5-video-support/" target="_blank"
                    >supports HTML5 video
                </a> --}}
                </p>
            </video>
        </div>
        <div>
            <a class="btn btn-sm btn-info" href="{{route('storage.download', $string)}}"> Download Video <i class="fas fa-arrow-down"></i> </a>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('vendor/videojs/dist/video.min.js')}}"></script>
@endpush