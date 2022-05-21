<?php

namespace App\Http\Controllers;

use App\Mail\TareasPendientes;
use App\Models\Tarea;
use App\Models\Etiqueta;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;

class TareaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }

    private $reglasValidacion = [
            'tarea' => 'required|min:5|max:255',
            'descripcion' => ['required','min:5','max:255'],
            'categoria' => 'required',
            'etiqueta_id' => 'required',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareas = Tarea::with('user:id,name,email')->with('etiquetas')->withTrashed()->get();
        //$tareas = Auth::user()->tareas;
        // $tareas = Auth::user()->tareas()->where('categoria','Escuela')->get();
        return view('tareas.indexTareas',compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Gate::authorize('admin', $tarea);

        $etiquetas = Etiqueta::all();
        return view('tareas.formTareas',compact('etiquetas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->reglasValidacion);

        $request->merge([
            'user_id' => Auth::id(),
        ]);
        $tarea = Tarea::create($request->all());

        $tarea->etiquetas()->attach($request->etiqueta_id);

        // $tarea = new Tarea();
        // $tarea->tarea = $request->tarea;
        // $tarea->descripcion = $request->descripcion;
        // $tarea->categoria = $request->categoria;

        // $user = Auth::user();
        // $user->tareas()->save($tarea);

        // $tarea = new Tarea();
        // $tarea->user_id = Auth::id();
        // $tarea->tarea = $request->tarea;
        // $tarea->descripcion = $request->descripcion;
        // $tarea->categoria = $request->categoria;
        // $tarea->save();

        return \redirect('/tarea');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function show(Tarea $tarea)
    {
        return view('tareas.showTarea', compact('tarea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarea $tarea)
    {
        $etiquetas = Etiqueta::all();
        return view('tareas.formTareas', compact('tarea', 'etiquetas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarea $tarea)
    {
        $request->validate($this->reglasValidacion);

        Tarea::where('id', $tarea->id)->update($request->except(['_token','_method','etiqueta_id']));

        $tarea->etiquetas()->sync($request->etiqueta_id);

        // $tarea->tarea = $request->tarea;
        // $tarea->descripcion = $request->descripcion;
        // $tarea->categoria = $request->categoria;
        // $tarea->save();

        return redirect ('/tarea/'.$tarea->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */

    public function destroy(Tarea $tarea)
    {
        if(!Gate::allows('admin', $tarea))
        {
            abort(403);
        }
        $tarea->delete();
        return redirect('/tarea');
    }
    
    public function borradoDb($tarea)
    {
        $tarea = Tarea::where('id', $tarea)->withTrashed()->first();
        $tarea->forceDelete();
        return redirect('/tarea');
    }

    public function enviarTareas()
    {
        Mail::to(Auth::user()->email)->send(new TareasPendientes());
        return redirect()->back();
    }
}
