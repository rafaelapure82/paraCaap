<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        
        $datos['empleado']=Empleado::paginate(5); //para pasarle al index.blade
        
        return view('empleado.index', $datos); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        //validacionesdeCampos
        $campos=[
            'Nombre'=>'required|string|max:100',
            'PrimerApellido'=> 'required|string|max:100',
            'SegundoApellido'=> 'required|string|max:100',
            'Correo'=> 'required|email',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',

        ];
            $mensaje=[
                    'required'=>'El :attribute es requerido',
                    'Foto.required'=>'La foto es requerida'

            ];

            $this->validate($request, $campos, $mensaje);




        //por aqui se pasan los datos del formulario
        //$datosEmpleado = request()->all();//esto incluyen el token
        $datosEmpleado = request()->except('_token');//esto quita el token oculta del envio

        //Metodo alamacenar la foto jpg
        if($request->hasFile('Foto')){
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');//carpeta store-uploads-public
        }


        Empleado::insert($datosEmpleado);//desde el controlador de arriba, inserto todos los datos del empleado
        //return response()->json($datosEmpleado);
        //con esto retorna los datos que me enviaron
        return redirect('empleado')->with('mensaje','Empleado agregado correctamente!');
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
        //recuperar los datos para editar

        $empleado=Empleado::findOrFail($id);

        return view('empleado.edit', compact('empleado') );   

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
        $datosEmpleado = request()->except(['_token','_method']);

        if ($request->hasFile('Foto')) {
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->Foto);
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads', 'public'); //carpeta store-uploads-public
        }


        Empleado::where('id','=',$id)->update($datosEmpleado);

        $empleado = Empleado::findOrFail($id);

        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $empleado = Empleado::findOrFail($id);//busca la foto

        if(Storage::delete('public/'.$empleado->Foto)) { //borra la foto con su nombre publico

            Empleado::destroy($id);//este id viene del index.blade, la parte del form delete/borrar


        }

        return redirect('empleado')->with('mensaje','Datos Eliminados!');
    }
}
