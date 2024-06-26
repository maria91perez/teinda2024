@extends('master')

@section('titulo', 'Listado de Facturas')

@section('contenido')
<div class="container text-center">
    <h1>Listado de Facturas</h1>
    {!! Form::open(['route' => 'facturas.index', 'method' => 'GET', 'class' => 'navbar-form']) !!}
    <div class="form-group">
        {!! Form::text('numero', null, ['class' => 'form-control', 'id' => 'numero', 'placeholder' => 'Buscar Facturas']) !!}
        <br>
        {!! Form::submit('Buscar Factura', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('facturas.index') }}" class="btn btn-primary">Mostrar Facturas</a>
    </div>
    <br>
{!! Form::close() !!}


    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#crearClienteModal">
        Crear Nueva Factura
    </button>
    
    <div class="modal fade" id="crearClienteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Factura</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí sSe carga la vista crear.blade.php -->
                    {!! Form::open(['route' => 'facturas.store', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {!! Form::label('numero', 'Número de la factura:') !!}
            {!! Form::text('numero', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Número de la factura...']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('valor', 'Valor de la factura:') !!}
            {!! Form::text('valor', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Valor de la factura...']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('detalles', 'Detalles de la factura:') !!}
                {!! Form::textarea('detalles', null, ['id' => 'editor', 'class' => 'form-control ckeditor', 'placeholder' => 'Detalles de la factura...']) !!}
<script>
    CKEDITOR.replace('editor');
</script>


        </div>
        <div class="form-group">
         {!! Form::label('idcliente', 'Clientes:') !!}
           {!! Form::select('idcliente', $clientes, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('idforma', 'Formas de Pago:') !!}
            {!! Form::select('idforma', $formas, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('idestado', 'Estados:') !!}
            {!! Form::select('idestado', $estados, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('archivo', 'Archivo:') !!}
            {!! Form::file('archivo', ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Guardar Factura', ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}

        </div>
            </div>
        </div>
    </div>
    <table class="table table-striped table-bordered table-hover table-success">
    <br>
        <thead>
            <tr>
                <th>Actualizar</th>
                <th>Eliminar</th>
                <th>Número</th>
                <th >Cliente</th>
                <th>RFC</th>

                <th>Valor</th>
                <th>Archivo</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facturas as $factura)
            <tr>
                    <td>
                        <!-- Botón para abrir el modal de edición de cliente -->
                        <a class="bi bi-pencil-square btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarClienteModal{{ $factura->id }}"></a>
                        

                        <!-- Modal para editar un cliente -->
                        <div class="modal fade" id="editarClienteModal{{ $factura->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar Factura</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Incluir el formulario de edición de cliente aquí -->
                                        {!! Form::model($factura, ['route' => ['facturas.update', $factura->id], 'method' => 'PUT', 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('numero', 'Número de factura') !!}
                {!! Form::text('numero', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>'Número de factura...']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('valor', 'Valor') !!}
                {!! Form::text('valor', null, ['class'=>'form-control', 'required'=>'required', 'placeholder'=>'Valor de la factura...']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('detalles', 'Detalles') !!}
                
                {!! Form::textarea('detalles', null, ['id' => 'editor', 'class' => 'form-control ckeditor', 'placeholder' => 'Detalles de la factura...']) !!}
            </div>
            <div class="form-group">
         {!! Form::label('idcliente', 'Clientes:') !!}
           {!! Form::select('idcliente', $clientes, null, ['class' => 'form-control ']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('idforma', 'Formas de Pago:') !!}
            {!! Form::select('idforma', $formas, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('idestado', 'Estados:') !!}
            {!! Form::select('idestado', $estados, null, ['class' => 'form-control']) !!}
        </div>
            <div class="form-group">
                {!! Form::label('archivo', 'Archivo:') !!}
                {!! Form::file('archivo', ['class'=>'form-control', 'placeholder'=>'archivo']) !!}
            </div>
            <br>
            {!! Form::submit('Guardar Factura', ['class'=>'btn btn-success']) !!}
        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <!-- Formulario para eliminar un cliente -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarClienteModal{{$factura->id}}">
    <i class="bi bi-trash"></i>
</button>

<!-- Modal para confirmar eliminación del cliente -->
<div class="modal fade" id="eliminarClienteModal{{$factura->id}}" tabindex="-1" aria-labelledby="eliminarClienteModalLabel{{$factura->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarClienteModalLabel{{$factura->id}}">Eliminar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-white">
    ¿Estás seguro de que deseas eliminar este cliente?
        </div>

            <div class="modal-footer">
                <!-- Formulario para eliminar cliente -->
                {!! Form::open(['route' => ['facturas.destroy', $factura->id], 'method' => 'DELETE']) !!}
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                {!! Form::close() !!}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
                    </td>
                    <td>{{ $facturas->numero }}</td>
                <td>{{ $facturas->Clientes->nombre}}</td>
                <td>{{ $facturas->Clientes->rfc}}</td>
                <td>${{number_format($facturass->valor)}}</td>
                
                <td><img class="imagen-factura" src="{{ asset('archivos/' . $factura->archivo) }}"></td>

                <td>{!! $factura->detalles !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $facturas->links() }}     
    <br>
   
    
</div>
@endsection



<style>
.imagen-factura {
    max-width: 85px;
    height: auto; /* Esto mantendrá la proporción de la imagen */
}
</style>
<style>
    label {
    color: #ffffff; /* Color blanco */
}
</style>
