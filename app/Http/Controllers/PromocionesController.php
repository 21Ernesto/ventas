<?php

namespace App\Http\Controllers;

use App\Models\Promociones;
use App\Http\Requests\StorePromocionesRequest;
use App\Http\Requests\UpdatePromocionesRequest;
use Illuminate\Http\Request;

class PromocionesController extends Controller
{

    public function index()
    {
        $promociones = Promociones::all();
        return view('admin.productos.productos', compact('promociones'));
    }


    public function create()
    {
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre_paquete' => 'required|string|max:255',
            'descripcion_paquete' => 'required|string',
            'costo_adulto' => 'required|numeric',
            'costo_ninio' => 'required|numeric',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Almacenar la imagen en la carpeta public/imagenes
        $rutaImagen = $request->hasFile('imagen') ? $request->file('imagen')->store('public/imagenes') : null;
    
        // Ajustar la ruta de almacenamiento para que sea pública
        $rutaImagen = $rutaImagen ? str_replace('public/', 'storage/', $rutaImagen) : null;
    
        $promocion = Promociones::create([
            'nombre_paquete' => $request->input('nombre_paquete'),
            'descripcion_paquete' => $request->input('descripcion_paquete'),
            'costo_adulto' => $request->input('costo_adulto'),
            'costo_ninio' => $request->input('costo_ninio'),
            'imagen' => $rutaImagen,
        ]);
    
        return redirect()->route('productos.index');
    }
    

    public function show(Promociones $promociones)
    {
        $promocion = Promociones::find($promociones->id);

        if (!$promocion) {
            abort(404, 'La promoción no fue encontrada');
        }
        return view('admin.productos.detalle', ['promocion' => $promocion]);
    }


    public function edit(Promociones $promociones)
    {
        $promocion = Promociones::find($promociones->id);

        if (!$promocion) {
            abort(404, 'La promoción no fue encontrada');
        }
        return view('admin.productos.editar', ['promocion' => $promocion]);
    }

    public function update(Request $request, Promociones $promociones)
    {
        $request->validate([
            'nombre_paquete' => 'required|string|max:255',
            'descripcion_paquete' => 'required|string',
            // 'catindad_dias' => 'required|integer',
            'costo_adulto' => 'required|numeric',
            'costo_ninio' => 'required|numeric',
        ]);

        $data = [
            'nombre_paquete' => $request->input('nombre_paquete'),
            'descripcion_paquete' => $request->input('descripcion_paquete'),
            // 'catindad_dias' => $request->input('catindad_dias'),
            'costo_adulto' => $request->input('costo_adulto'),
            'costo_ninio' => $request->input('costo_ninio'),
        ];

        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('public/imagenes');
            $rutaImagen = str_replace('public/', 'storage/', $rutaImagen);
            $data['imagen'] = $rutaImagen;
        }

        $promociones->update($data);

        return redirect()->route('productos.index', ['promociones' => $promociones->id]);
    }


    public function destroy(Promociones $promocion)
    {
        $promocion->delete();
        return redirect()->route('productos.index');
    }

    public function activate(Promociones $promocion)
    {
        $promocion->update(['promocion' => 1]);

        return redirect()->route('productos.index');
    }

    public function deactivate(Promociones $promocion)
    {
        $promocion->update(['promocion' => 0]);

        return redirect()->route('productos.index');
    }
}
