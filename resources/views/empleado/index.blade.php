@extends('layouts.app')

@section('page-title', 'Tipos de Formulario')
@section('ngApp', 'users')
@section('ngController', 'users')
@section('content')
<div class="container">


<a ng-click="create()" class="btn btn-success"> Crear nuevo empleado </a>
<br><br>
<table class="table table-light">
  {{-- Títulos --}}
  <thead class="thead-light">
    <tr>
      <th>#</th>
      <th>Nombre</th>
      <th>Apellido Paterno</th>
      <th>Apellido Materno</th>
      <th>Correo</th>
      <th>Acciones</th>
    </tr>
  </thead>
  {{-- Información almacenada en la BD --}}
  <tbody ng-cloak>
    <tr ng-repeat="user in users track by $index">
      <td>@{{user.id }}</td>
      <td>@{{user.Nombre}}</td>
      <td>@{{user.ApellidoPaterno}}</td>
      <td>@{{user.ApellidoMaterno}}</td>
      <td>@{{user.Correo }}</td>
      <td>
        <button type="button" class="btn btn-sm btn-primary" ng-click="edit(user)"><i class="fas fa-edit"></i> Editar empleado</button>
        <button type="button" class="btn btn-sm btn-danger" ng-click="delete(user.id)"><i class="fas fa-trash"></i> Eliminar empleado</button>
      </td>
    </tr>
  </tbody>
</table>
</div>



{{-- Modal para crear un nuevo usuario --}}
<div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalAgregar">Agregar Empleado</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form id="formularioCreacion" ng-submit="store()" class="was-validated">
                  <div class="form-group">
                      <label for="nombre">Nombre(s):</label>
                      <input type="text" name="nombre" id="Nombre" class="form-control" placeholder="Nombre" ng-model="formularioCreacion.nombre" required autofocus>
                      <br>
                      <label for="apellidop">Apellido Paterno:</label>
                      <input type="text" name="apellidop" id="ApellidoPaterno" class="form-control" placeholder="Apellido Paterno" ng-model="formularioCreacion.apellidop" required autofocus>
                      <br>
                      <label for="apellidom">Apellido Materno:</label>
                      <input type="text" name="apellidom" id="ApellidoMaterno" class="form-control" placeholder="Apellido Materno" ng-model="formularioCreacion.apellidom" required autofocus>
                      <br>
                      <label for="correo">Correo:</label>
                      <input type="text" name="correo" id="Correo" class="form-control" placeholder="Correo" ng-model="formularioCreacion.correo" required autofocus>
                  </div>
                  <br>
                  <div class="form-group">
                      <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

{{-- Modal para editar a un usuario ya creado --}}
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modalEditarLabel">Editar empleado</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <form ng-submit="update()" class="was-validated">
                  <input type="hidden" name="id" id="edit-id">
                  <div class="form-group">
                      <label for="nombre">Nombre:</label>
                      <input type="text" name="nombre" id="edit-nombre" class="form-control" placeholder="Nombre" ng-model="editForm.nombre">
                      <br>
                      <label for="apellidop">Apellido Paterno:</label>
                      <input type="text" name="apellidop" id="edit-apellidop" class="form-control" placeholder="Apellido Paterno" ng-model="editForm.apellidop">
                      <br>
                      <label for="apellidom">Apellido Materno:</label>
                      <input type="text" name="apellidom" id="edit-apellidom" class="form-control" placeholder="Apellido Materno" ng-model="editForm.apellidom">
                      <br>
                      <label for="correo">Correo:</label>
                      <input type="text" name="correo" id="edit-correo" class="form-control" placeholder="Correo" ng-model="editForm.correo">
                  </div>
                  <br>
                  <div class="form-group">
                      <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

{{-- Modal para eliminar a un usuario ya creado --}}

<div class="modal fade" id="btn_eliminar" tabindex="-1" aria-labelledby="btn_eliminarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="btn_eliminarLabel">Crear tipo_campo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              ¿Realmente desea eliminar al tipo_campo <span class="font-weight-bold" id="nombre_eliminar"></span>?
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger" ng-click="delete(user)">Eliminar</button>
          </div>
      </div>
  </div>
</div>

@endsection


@section('ngFile')
<script src="{{ asset('js/users.js') }}"></script>
@endsection