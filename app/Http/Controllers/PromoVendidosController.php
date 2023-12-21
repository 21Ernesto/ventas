<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

use App\Models\PromoVendidos;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdatePromoVendidosRequest;
use App\Mail\CompraRealizada;
use App\Models\Correos;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;



class PromoVendidosController extends Controller
{

    public function index()
    {
        $ventas = PromoVendidos::all();
        return view('admin.ventas.index', compact('ventas'));
    }

    public function create()
    {
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'correo' => 'required|email',
            'cantidad_adultos' => 'required|integer|min:1',
            'cantidad_ninio' => 'required|integer|min:0',
            'promocion_id' => 'required|exists:promociones,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $promocionId = $request->input('promocion_id');
        $nombre = $request->input('nombre');
        $correo = $request->input('correo');
        $cantidadAdultos = $request->input('cantidad_adultos');
        $cantidadNinios = $request->input('cantidad_ninio', 0);

        $costoAdulto = $request->input('costo_adulto', 0);
        $costoNinio = $request->input('costo_ninio', 0);

        $total = ($costoAdulto * $cantidadAdultos) + ($costoNinio * $cantidadNinios);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            Charge::create([
                'amount' => $total * 100, // Convertir el monto a centavos
                'currency' => 'MXN',
                'source' => $request->input('stripeToken'),
                'description' => 'Compra de ' . $nombre,
            ]);

            // Crear el registro de compra en la base de datos
            $compra = PromoVendidos::create([
                'promocion_id' => $promocionId,
                'nombre' => $nombre,
                'correo' => $correo,
                'cantidad_adultos' => $cantidadAdultos,
                'cantidad_ninio' => $cantidadNinios,
                'total' => $total,
            ]);

            // Enviar correo electrónico personalizado al comprador
            Mail::to($correo)->send(new CompraRealizada($compra));

            // Aquí puedes obtener los correos de la tabla correos y enviarles el correo estándar
            // Recuerda ajustar esto según la lógica específica de tu aplicación

            return redirect()->route('dashboard')->with('success', 'Compra realizada con éxito');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }



    public function show(PromoVendidos $promoVendidos)
    {
    }

    public function edit(PromoVendidos $promoVendidos)
    {
    }

    public function update(UpdatePromoVendidosRequest $request, PromoVendidos $promoVendidos)
    {
    }

    public function destroy(PromoVendidos $promoVendidos)
    {
    }
}
