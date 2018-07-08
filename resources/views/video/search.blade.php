@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="container">
						<h2>Busqueda:{{ $search }}</h2>
					<div class="col-md-10 pull-left">
						<form action="{{ '/buscar/'.$search }}" method="get" class="col-md-3 pull-right">
							<label for="filter">Ordenar</label>
							<select name="filter" id="filter" class="form-control">
								<option value="new">Mas nuevos </option>
								<option value="old">Mas Antiguos</option>
								<option value="alfa">de la A a la Z</option>
							</select>
						<button type="submit" class="btn btn-primary btn-sm">Ordenar</button>
					<br>

						</form>
					</div>
          @include('video.videoslist')
        </div>
        {{$videos->links()}}
    </div>
</div>
@endsection