<?php

namespace App\Http\Controllers;

use App\Models\Promociones;
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
            'costo_adulto_pro' => 'required|numeric',
            'costo_ninio_pro' => 'required|numeric',
            'costo_adulto' => 'required|numeric',
            'costo_ninio' => 'required|numeric',
            'rango_edad' => 'required|string',
            'correo_1' => 'required|string',
            'correo_2' => 'required|string',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $rutaImagen = null;

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $rutaImagen = 'imagenes/' . time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('imagenes'), $rutaImagen);
        }

        $promocion = Promociones::create([
            'nombre_paquete' => $request->input('nombre_paquete'),
            'descripcion_paquete' => $request->input('descripcion_paquete'),
            'costo_adulto_pro' => $request->input('costo_adulto_pro'),
            'costo_ninio_pro' => $request->input('costo_ninio_pro'),
            'costo_adulto' => $request->input('costo_adulto'),
            'costo_ninio' => $request->input('costo_ninio'),
            'rango_edad' => $request->input('rango_edad'),
            'correo_1' => $request->input('correo_1'),
            'correo_2' => $request->input('correo_2'),
            'imagen' => $rutaImagen,
        ]);

        return redirect()->route('productos.index');
    }


    public function show(Promociones $promociones)
    {
        $promocion = Promociones::find($promociones->id);
        $fechaActual = now()->format('Y-m-d');

        if (!$promocion) {
            abort(404, 'La promoción no fue encontrada');
        }
        return view('admin.productos.detalle', ['promocion' => $promocion, 'fechaActual' => $fechaActual]);
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
            'costo_adulto_pro' => 'required|numeric',
            'costo_ninio_pro' => 'required|numeric',
            'costo_adulto' => 'required|numeric',
            'costo_ninio' => 'required|numeric',
            'rango_edad' => 'required|string',
            'correo_1' => 'required|string',
            'correo_2' => 'required|string',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'nombre_paquete' => $request->input('nombre_paquete'),
            'descripcion_paquete' => $request->input('descripcion_paquete'),
            'costo_adulto_pro' => $request->input('costo_adulto_pro'),
            'costo_ninio_pro' => $request->input('costo_ninio_pro'),
            'costo_adulto' => $request->input('costo_adulto'),
            'costo_ninio' => $request->input('costo_ninio'),
            'rango_edad' => $request->input('rango_edad'),
            'correo_1' => $request->input('correo_1'),
            'correo_2' => $request->input('correo_2'),
        ];

        if ($request->hasFile('imagen')) {
            if ($promociones->imagen) {
                $rutaImagenAnterior = public_path($promociones->imagen);
                if (file_exists($rutaImagenAnterior)) {
                    unlink($rutaImagenAnterior);
                }
            }

            // Guardar la nueva imagen
            $imagen = $request->file('imagen');
            $rutaImagen = 'imagenes/' . time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('imagenes'), $rutaImagen);

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
