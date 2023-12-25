<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

use App\Models\PromoVendidos;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdatePromoVendidosRequest;
use App\Mail\CompraRealizada;
use App\Mail\CorreoAdmin;
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
            'telefono' => 'required|string',
            'correo' => 'required|email',
            'cantidad_adultos' => 'required|integer|min:1',
            'cantidad_ninio' => 'required|integer|min:0',
            'nombre_paquete' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $nombre_paquete = $request->input('nombre_paquete');
        $telefono = $request->input('telefono');
        $nombre = $request->input('nombre');
        $correo = $request->input('correo');
        $cantidadAdultos = $request->input('cantidad_adultos');
        $cantidadNinios = $request->input('cantidad_ninio', 0);

        $costoAdulto = $request->input('costo_adulto', 0);
        $costoNinio = $request->input('costo_ninio', 0);

        $total = ($costoAdulto * $cantidadAdultos) + ($costoNinio * $cantidadNinios);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::create([
                'amount' => $total * 100,
                'currency' => 'MXN',
                'source' => $request->input('stripeToken'),
                'description' => 'Compra de ' . $nombre,
                'receipt_email' => $correo,
                'metadata' => [
                    'Nombre' => $nombre, 
                ],
            ]);

            $compra = PromoVendidos::create([
                'nombre_paquete' => $nombre_paquete,
                'telefono' => $telefono,
                'nombre' => $nombre,
                'correo' => $correo,
                'cantidad_adultos' => $cantidadAdultos,
                'cantidad_ninio' => $cantidadNinios,
                'total' => $total,
            ]);

            $correos = Correos::pluck('email')->toArray();

            try {
                Mail::to($correo)->send(new CompraRealizada($compra));

                foreach ($correos as $correoDestino) {
                    Mail::to($correoDestino)->send(new CorreoAdmin($compra));
                }
                return view('comprafinalizada');

            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage())->withInput();
            }
            
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
