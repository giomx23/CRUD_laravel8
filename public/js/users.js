var app = angular.module('users', []);


app.controller('users', function ($scope, $http) {
  $scope.users=[];
  $scope.createForm = {};
  $scope.editForm = {};

  $http({
    url: 'obteneru',
    method: 'GET',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
}).then(
    function successCallback(response) {
        console.log(response);
        $scope.users = response.data;
    },
    function errorCallback(response) {
        console.log(response);
        swal(
            configuraciones.titulo,
            response.data.message,
            tiposDeMensaje.error
        );
    }
);
$scope.create = function () {

  $http({
      url: 'obteneru/create',
      method: 'GET',
      headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
      },
  }).then(
      function successCallback(response) {
          console.log(response);
          $('#formularioCreacion').trigger('reset');
          $('#modalAgregar').modal('show');
      },
      function errorCallback(response) {
          console.log(response);
          swal(
              'Mensaje del Sistema',
              response.data.message,
              response.data.status
          );
      }
  );
}

$scope.store = function () {

  $http({
      url: 'obteneru',
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
      },
      data: $scope.formularioCreacion
  }).then(
      function successCallback(response) {
          console.log(response);
          $scope.users = [...$scope.users, response.data.empleado];
          $('#formularioCreacion').trigger('reset');
          $('#modalAgregar').modal('hide');
          swal(
              'Mensaje del Sistema',
              response.data.message,
              response.data.status
          );
      },
      function errorCallback(response) {
          console.log(response);
          //$('#modalAgregar').modal('hide');

          if (response.status === 422) {
              let mensaje = '';
              for (let i in response.data.errors) {
                  mensaje += response.data.errors[i] + '\n';
              }
              swal('Mensaje del Sistema', mensaje, 'error');
          } else {
              swal(
                  'Mensaje del Sistema',
                  response.data.message,
                  response.data.status
              );
          }

      }
  );
}

$scope.edit = function (empleado) {
  if(empleado.id) $scope.editForm['id'] = empleado.id;
  if(empleado.Nombre) $scope.editForm['nombre'] = empleado.Nombre;
  if(empleado.ApellidoPaterno) $scope.editForm['apellidop'] = empleado.ApellidoPaterno;
  if(empleado.ApellidoMaterno) $scope.editForm['apellidom'] = empleado.ApellidoMaterno;
  if(empleado.Correo) $scope.editForm['correo'] = empleado.Correo;

  $http({
      url: 'obteneru/edit',
      method: 'GET',
      headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
      },
  }).then(
      function successCallback(response) {
          console.log(response);
          $('#modalEditar').modal('show');
      },
      function errorCallback(response) {
          console.log(response);
          swal(
              'Mensaje del Sistema',
              response.data.message,
              response.data.status
          );
      }
  );
}

$scope.update = function () {

  $http({
      url: `datosactualizados`,
      method: 'PUT',
      data: $scope.editForm,
      headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
      },
  }).then(
      function successCallback(response) {
          console.log('response: ', response);
          $scope.empleado = response.data.empleado;
          $scope.users = $scope.users.map(empleado => (empleado.id == response.data.empleado.id) ? empleado = response.data.empleado : empleado);
          $('#modalEditar').modal('hide');
          swal(
              'Mensaje del Sistema',
              response.data.message,
              response.data.status
          );
      },
      function errorCallback(response) {
          console.log(response);
          if (response.status === 422) {
              let mensaje = '';
              for (let i in response.data.errors) {
                  mensaje += response.data.errors[i] + '\n';
              }
              swal('Mensaje del Sistema', mensaje, 'error');
          } else {
              swal(
                  'Mensaje del Sistema',
                  response.data.message,
                  response.data.status
              );
          }
      }
  );
}

$scope.confirmarEliminar = function (users) {
    $scope.users = users;
    $('#nombre_eliminar').html(users.nombre);
    $('#btn_eliminar').modal('show');
}

$scope.delete = function (user_id) {
    console.log('id: ', user_id);

    $http({
        url: `obteneru/${user_id}`,
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
    }).then(
        function successCallback(response) {
            console.log(response);
            console.log(response.data.empleado);
            $scope.users = $scope.users.filter(user => user.id !== response.data.empleado.id);
            $('#btn_eliminar').modal('hide');
            swal(
                'Mensaje del Sistema',
                response.data.message,
                response.data.status
            );
        },
        function errorCallback(response) {
            console.log(response);
            swal(
                'Mensaje del Sistema',
                response.data.message,
                response.data.status
            );
        }
    );
}
});