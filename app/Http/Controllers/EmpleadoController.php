<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use function Ramsey\Uuid\v1;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('empleado.index');
    }

    public function getusers(){
        $users=Empleado::get();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'code' => 200,
            'status' => 'success',
        ];
        return response()->json($data, $data['code']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validar campos
        $vcampos=[
            'nombre' => 'required|string|max:50',
            'apellidop' => 'required|string|max:50',
            'apellidom' => 'required|string|max:50',
            'correo' => 'required|email',
        ];
        $this->validate($request,$vcampos);//Validación de campos

        try {
            $empleado = new Empleado();
            $empleado->Nombre = $request->nombre;
            $empleado->ApellidoPaterno = $request->apellidop;
            $empleado->ApellidoMaterno = $request->apellidom;
            $empleado->Correo = $request->correo;
            $empleado->save();

            if(is_object($empleado)) {
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'message' => '¡Usuario creado de manera exitosa!',
                    'empleado' => $empleado,
                ];
            }
            return response()->json($data, $data['code']);
        } catch (\Throwable $th) {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error al guardar.'.$th,
            ];
            return response()->json($data, $data['code']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data = [
            'code' => 200,
            'status' => 'success',
        ];
        return response()->json($data, $data['code']);
    }

    public function update(Request $request)
    {
        //return $request;
        //falta validar request
        //Validar campos
        $vcampos=[
            'nombre' => 'required|string|max:50',
            'apellidop' => 'required|string|max:50',
            'apellidom' => 'required|string|max:50',
            'correo' => 'required|email',
        ];
        $this->validate($request, $vcampos);

        if($request->id)
            $empleado = Empleado::where('id',$request->input('id'))->first();

        try {
            if(is_object($empleado)) {

                $empleado->Nombre = $request->nombre;
                $empleado->ApellidoPaterno = $request->apellidop;
                $empleado->ApellidoMaterno = $request->apellidom;
                $empleado->Correo = $request->correo;
                $empleado->save();

                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Empleado editado correctamente',
                    'empleado' => $empleado,
                ];

                return response()->json($data, $data['code']);
            }
        } catch (\Throwable $th) {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Error a la hora de editar al empleado'.$th,
            ];
            return response()->json($data, $data['code']);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::where('id',$id)->first();

        if(is_object($empleado)) {
            $empleado->delete();
            $data = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Usuario eliminado',
                'empleado' => $empleado,
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Erro, algo salió mal',
            ];
        }
        return response()->json($data, $data['code']);
    }
}
