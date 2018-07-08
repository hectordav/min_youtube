<div id="videos-list">
          @if (count($videos)>=1)
            @foreach ($videos as $key)
                <div class="video-item col-md-10 pull-left panel panel-default">
                  <div class="panel-body">
                     @if (Storage::disk('images')->has($key->image))
                      <div class="video-image-thumb col-md-3 pull-left">
                        <div class="video-image-mask">
                          <img src="{{ url('/miniatura/'.$key->image) }}" class="video-image" alt="">
                        </div>
                      </div>
                     @endif
                    <div class="data">
                      <h4 class="video-title"><a href="{{ url('/video/'.$key->id) }}">{{ $key->title }}</a></h4>
                      <p>{{ $key->user->name.' '.$key->user->surname }}</p>
                    </div>
                     <a href="{{ url('/video/'.$key->id) }}" class="btn btn-success">Ver</a>
                   @if (Auth::check() && Auth::user()->id==$key->user->id)
                     <a href="{{ url('/editar-video/'.$key->id) }}" class="btn btn-warning">Editar</a>
                     <a href="#victorModal{{ $key->id }}"" class="btn btn-danger" data-toggle="modal">Eliminar</a>

                      <div id="victorModal{{ $key->id }}" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">¿Estás seguro?</h4>
                                </div>
                                <div class="modal-body">
                                    <p>¿Seguro que quieres borrar este video?</p>
                                    <p class="text-warning"><small>{{ $key->title }}</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <a href="{{ url('/delete-video/'.$key->id) }}" type="button" class="btn btn-danger">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                   @endif
                  </div>
                </div>
                
            @endforeach
            @else
            <div class="alert alert-warning">
              NO hay Videos
            </div>
          @endif
        </div>