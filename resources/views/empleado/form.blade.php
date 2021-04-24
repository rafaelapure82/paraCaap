<h1>{{ $modo }} Empleado</h1>

@if(count($errors)>0)

<div class="alert alert-warning " role="alert">
    <ul><strong>@foreach( $errors->all() as $error )
            <li>{{ $error }} </li>
            @endforeach
        </strong>

    </ul>
</div>


@endif

<div class="form-group">

    <br>
    <label for="Nombre">Nombre</label>
    <input type="text" name="Nombre" class="form-control" value="{{ isset($empleado->Nombre)?$empleado->Nombre:'' }}" id="Nombre">

</div>

<div class="form-group">
    <label for="PrimerApellido">Primer Apellido</label>
    <input type="text" name="PrimerApellido" class="form-control" value="{{ isset($empleado->PrimerApellido)?$empleado->PrimerApellido:'' }}" id="PrimerApellido">

</div>
<div class="form-group">
    <label for="SegundoApellido">Segundo Apellido</label>
    <input type="text" name="SegundoApellido" class="form-control" value="{{ isset($empleado->SegundoApellido)?$empleado->SegundoApellido:'' }}" id="SegundoApellido">

</div>
<div class="form-group">
    <label for="Correo">Correo</label>
    <input type="text" name="Correo" class="form-control" value="{{ isset($empleado->Correo)?$empleado->Correo:'' }}" id="Correo">

</div>
<div class="form-group">

    <label for="Foto"></label>
    @if(isset($empleado->Foto))

    <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" width="100" alt="">
    @endif
</div>
<div class="form-group">
    <input type="file" name="Foto" class="btn btn-outline-primary" class="form-control" value="" id="Foto">
    <br>
    <br>
    <input type="submit" class="btn btn-outline-dark" value="{{ $modo }} Datos">

    <a class="btn btn-primary" href="{{ url('empleado/') }}">Volver</a>
</div>