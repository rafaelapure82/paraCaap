@extends('layouts.app')

@section('content')
<div class="container">



    @if(Session::has('mensaje'))

    {{ Session::get('mensaje') }}

    @endif

    <a href="{{ url('empleado/create') }}" class="btn btn-success">Registrar Nuevo</a>
    <br>
    <br>

    <table class="table table-striped table-inverse table-responsive">

        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Correo</th>
                <th>Foto</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ( $empleado as $empleado )
            <tr>
                <td scope="row">{{ $empleado->id  }}</td>
                <td>{{ $empleado->Nombre  }}</td>
                <td>{{ $empleado->PrimerApellido  }}</td>
                <td>{{ $empleado->SegundoApellido  }}</td>
                <td>{{ $empleado->Correo  }}</td>

                <td>
                    <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" width="75" alt="">

                    {{ $empleado->Foto  }}


                </td>
                <td>

                    <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-warning">

                        Editar
                    </a>
                    

                    <form action="{{ url('/empleado/'.$empleado->id) }}" class="d-inline" method="post">
                        @csrf

                        {{ method_field('DELETE') }}
                        <input type="submit" onclick="return confirm('¿Deseas Borrar el Registro?')" class="btn btn-danger" value="Borrar">


                    </form>

                </td>
            </tr>
            @endforeach
            <tr>
                <td scope="row"></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>

    </table>
</div>
@endsection
