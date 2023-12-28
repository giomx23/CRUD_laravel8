{{-- Formulario que se relaciona con create y edit --}}
<h3>Formulario para {{$manera}} un nuevo empleado</h3>

{{-- @if(count($errors) > 0)
  <div class="alert alert-danger" role="alert">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
@endif --}}

{{-- <div class="form-group">
<label for="Nombre">Nombre: </label>
<input type="text" class="form-control" name="Nombre" value="{{ isset($empleado->Nombre)?$empleado->Nombre:old('Nombre')}}" id="Nombre">
<br>
</div>

<div class="form-group">
<label for="ApellidoPaterno">Apellido Paterno: </label>
<input type="text" class="form-control" name="ApellidoPaterno" value="{{ isset($empleado->ApellidoPaterno)?$empleado->ApellidoPaterno:old('ApellidoPaterno')}}" id="ApellidoPaterno">
<br>
</div>

<div class="form-group">
<label for="ApellidoMaterno">Apellido Materno: </label>
<input type="text" class="form-control" name="ApellidoMaterno" value="{{ isset($empleado->ApellidoMaterno)?$empleado->ApellidoMaterno:old('ApellidoMaterno')}}" id="ApellidoMaterno">
<br>
</div>

<div class="form-group">
<label for="Correo">Correo: </label>
<input type="text" class="form-control" name="Correo" value="{{ isset($empleado->Correo)?$empleado->Correo:old('Correo')}}" id="Correo">
<br>
</div>

<div class="form-group">
<label for="Foto">Foto: </label>
{{-- {{$empleado->Foto}} --}}
{{-- @if(isset($empleado->Foto))
<img src="{{asset('storage').'/'.$empleado->Foto}}" class="img-thumbnail img-fluid" width="100px" height="100px" alt="">
@endif
<input type="file" class="form-control" name="Foto" id="Foto">
<br>
</div>

<input type="submit" class="btn btn-success" value="{{$manera}} Datos" >

<a href="{{url('empleado/')}}" class="btn btn-dark"> Regresar al Inicio </a> --}}