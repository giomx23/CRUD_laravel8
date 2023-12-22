@extends('layouts.app')

@section('content')
<div class="container">

{{-- Para mostrar mensaje dependiendo de que se haga --}}

  @if(Session::has('mensaje'))
  <div class="alert alert-success alert-dismissible" role="alert">
      {{Session::get('mensaje')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  @endif


<a href="{{url('empleado/create')}}" class="btn btn-success"> Crear nuevo empleado </a>
<br><br>
<table class="table table-light">
  {{-- Títulos --}}
  <thead class="thead-light">
    <tr>
      <th>#</th>
      <th>Foto</th>
      <th>Nombre</th>
      <th>Apellido Paterno</th>
      <th>Apellido Materno</th>
      <th>Correo</th>
      <th>Acciones</th>
    </tr>
  </thead>
  {{-- Información almacenada en la BD --}}
  <tbody>
    {{-- El conjunto de datos que se encuentra en el controlador $empleados se pasa a la variable $empleado --}}
    @foreach($empleados as $empleado)
    <tr>
      <td>{{$empleado->id}}</td>
      {{-- Para visualizar la imagen que se sube --}}
      <td>
        <img src="{{asset('storage').'/'.$empleado->Foto}}" width="100px" height="100px" alt="" class="img-thumbnail img-fluid">
      </td>
      <td>{{$empleado->Nombre}}</td>
      <td>{{$empleado->ApellidoPaterno}}</td>
      <td>{{$empleado->ApellidoMaterno}}</td>
      <td>{{$empleado->Correo}}</td>
      <td>

        {{-- Boton que nos direcciona a que se edite el empleado dependiendo de su id --}}
        <a href="{{url('/empleado/'.$empleado->id.'/edit')}}" class="btn btn-info"> Editar empleado </a>

        |

        <form action="{{url('/empleado/'.$empleado->id)}}" class="d-inline" method="post">
          @csrf
          {{method_field('DELETE')}} 
          <input type="submit" onclick="return confirm('¿Deseas eliminar al empleado?')" value="Eliminar empleado" class="btn btn-danger">
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{!!$empleados->links()!!}
</div>
@endsection