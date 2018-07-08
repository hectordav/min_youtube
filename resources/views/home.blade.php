@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
          @include('video.videoslist')
        </div>
        {{$videos->links()}}
    </div>
</div>
@endsection


