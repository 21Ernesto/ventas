<?php

namespace App\Http\Controllers;

use App\Models\Correos;
use App\Http\Requests\StoreCorreosRequest;
use App\Http\Requests\UpdateCorreosRequest;
use Illuminate\Http\Request;

class CorreosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $correos = Correos::all();
        return view('admin.correos.correos', compact('correos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string',
        ]);

        $correos = Correos::create([
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
        ]);
        return redirect()->route('correos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Correos $correos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Correos $correos)
    {
        return view('admin.correos.editar', compact('correos'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Correos $correos)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string',
        ]);

        $data = [
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
        ];

        $correos->update($data);

        return redirect()->route('correos.index', ['correos' => $correos->id]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Correos $correos)
    {
        $correos->delete();

        return redirect()->route('correos.index');
    }
}
