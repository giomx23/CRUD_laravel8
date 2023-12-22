<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
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
        //
        //Consulta de datos almacenados en la base de datos
        $datosAlmacenados['empleados']=Empleado::paginate(1);
        return view('empleado.index',$datosAlmacenados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
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
            'Nombre' => 'required|string|max:50',
            'ApellidoPaterno' => 'required|string|max:50',
            'ApellidoMaterno' => 'required|string|max:50',
            'Correo' => 'required|email',
            'Foto' => 'required|max:10000|mimes:jpeg,jpg,png',
        ];
        //Mensaje que arroja cuando el campo es requerido
        $mensaje=[
            'required' => 'El campo :attribute es requerido',
        ];

        $this->validate($request,$vcampos,$mensaje);//Validación de campos con los mensajes de validación

        //$datosEmpleado = $request->all();
        //obtiene todos los datos del formulario, exceptuando el token para que se guarde en la BD
        $datosEmpleado = $request->except('_token');

        //Se adjunta la foto a storage->app->public->uploads
        /*La foto que se suba ya no será de manera temporal (.tmp) sino que se almacena en uploads con formato .jpg*/
        if($request->hasFile('Foto')){
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }
        Empleado::insert($datosEmpleado);

        return redirect('empleado')->with('mensaje','Se ha creado con éxito el empleado');
        //return response()->json($datosEmpleado);
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
    public function edit($id)
    {
        //
        $empleado=Empleado::findOrFail($id); //Aquí se busca la información apartir del id para que luego sea modificada
        return view('empleado.edit',compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validar campos
        $vcampos=[
            'Nombre' => 'required|string|max:50',
            'ApellidoPaterno' => 'required|string|max:50',
            'ApellidoMaterno' => 'required|string|max:50',
            'Correo' => 'required|email',
        ];
        //Mensaje que arroja cuando el campo es requerido
        $mensaje=[
            'required' => 'El campo :attribute es requerido',
        ];

        if($request->hasFile('Foto')){
            $campos=['Foto' => 'required|max:10000|mimes:jpeg,jpg,png'];
        }

        $this->validate($request,$vcampos,$mensaje);//Validación de campos con los mensajes de validación

        $datosEmpleado = $request->except(['_token','_method']); //Se quita el token y el metodo ya que no nos servirá a la hora de actualizar

        if($request->hasFile('Foto')){
            $empleado=Empleado::findOrFail($id); //Se recupera la información
            Storage::delete('/public/'.$empleado->Foto);
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Empleado::where('id','=', $id)->update($datosEmpleado); //Se busca el registro respecto al id y si existe, se podrá actualizar

        $empleado=Empleado::findOrFail($id); //Aquí se busca la información apartir del id para que luego sea modificada

        //return view('empleado.edit',compact('empleado'));

        return redirect('empleado')->with('mensaje','Se ha modificado con éxito al empleado'); //cuando se borre nos redirecciona nuevamente en el index, en este casa se encuentra en /empleado
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $empleado=Empleado::findOrFail($id); //Se recupera la información

        if(Storage::delete('/public/'.$empleado->Foto)){ //Busca dentro la carpeta public/storage/uploads la imagen que se desea eliminar
            Empleado::destroy($id); //Y si está se elimina
        }

        Empleado::destroy($id);
        return redirect('empleado')->with('mensaje','Se ha eliminado con éxito al empleado'); //cuando se borre nos redirecciona nuevamente en el index, en este casa se encuentra en /empleado
    }
}
