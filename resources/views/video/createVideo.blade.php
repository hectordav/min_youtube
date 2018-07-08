@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<h2>Crear un nuevo video</h2>
		<hr>
		<form action="{{ url('/guardar-video') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
			{!! csrf_field() !!}
			@if ($errors->any())
				<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $key)
								<li>
									{{ $key }}
								</li>
							@endforeach
						</ul>
				</div>
			@endif
				<div class="form-group">
					<label for="title">Titulo</label>
					<input type="text" class="form-control" placeholder="" id="title" name="title" value="{{ old('title') }}">
				</div>
				<div class="form-group">
					<label for="description">Descripcion</label>
						<textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ old('description') }}</textarea>
				</div>
				<div class="form-group">
					<label for="image">Miniature</label>
						<input type="file" class="form-control" name="image" id="image">
				</div>
				<div class="form-group">
					<label for="video">Video</label>
						<input type="file" class="form-control" name="video" id="video">
				</div>
						<button type="submit" class="btn btn-success">Crear Video</button>
		</form>
	</div>
</div>
@endsection