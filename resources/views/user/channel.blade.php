@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="container">
						<h2>Canal de {{ $user->name.' '.$user->surname }}</h2>
					
          @include('video.videoslist')
        </div>
        {{$videos->links()}}
    </div>
</div>
@endsection
