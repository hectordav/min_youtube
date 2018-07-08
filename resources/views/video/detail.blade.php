@extends('layouts.app')
@section('content')

	<div class="col-md-11 col-md-offset-1">
		<h2>{{ $video->title }}</h2>
		<hr>
		<div class="col-md-8">
			{{-- video --}}
			<video  controls id="video-player">
				<source src="{{ url('/video-file/'.$video->video_path) }}">
				tu navegador no es compatible ojo
			</video>
			{{-- descripcion --}}
		<div class="panel panel-default video-data">
			<div class="panel-heading">
				<div class="panel-title">
					subido por: <strong>{{ $video->user->name.' '.$video->user->surname }}</strong> {{ \FormatTime::LongTimeFilter($video->created_at) }}
				</div>
			</div>
			<div class="panel-body">
				{{ $video->description }}
			</div>
		</div>
		
			@include('video.comments')
		</div>
	</div>

@endsection