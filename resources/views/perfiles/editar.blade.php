<!-- Formulario de edición del cliente -->
{!! Form::model($perfil, ['route' => ['perfiles.update', $perfil->id], 'method' => 'PUT']) !!}
    <div class="form-group">
        {!! Form::label('nombre', 'Nombre del perfil', ['class' => 'titulo-blanco']) !!}
        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre del perfil...']) !!}
    </div>
    
    {!! Form::submit('Guardar Perfil', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
<!-- Modal para editar cliente -->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarModalLabel">Editar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario de edición del cliente -->
                <form action="{{ route('perfiles.update', $perfil->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Cliente</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $perfil->nombre }}" required>
                    </div>
                              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    .titulo-blanco {
    color: #ffffff; /* Color blanco */
}
</style>