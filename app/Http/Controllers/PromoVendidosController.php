<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

use App\Models\PromoVendidos;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdatePromoVendidosRequest;
use App\Mail\CompraRealizada;
use App\Mail\CorreoAdmin;
use App\Mail\Proveedor;
use App\Models\Correos;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;



class PromoVendidosController extends Controller
{

    // public function index(Request $request)
    // {
    //     $fechaActual = now()->format('Y-m-d');
    //     $fechaBusqueda = $request->input('fecha', $fechaActual);

    //     $ventas = PromoVendidos::whereDate('created_at', $fechaBusqueda)->get();

    //     if ($request->ajax()) {
    //         $diferencial = number_format(
    //             $ventas->sum(function ($venta) {
    //                 return $venta->costo_real_adul + $venta->costo_real_nini;
    //             }),
    //             2,
    //             '.',
    //             ',',
    //         );

    //         $ganancias = number_format($ventas->sum('total'), 2, '.', ',');

    //         return response()->json(['ventas' => $ventas, 'fechaActual' => $fechaActual, 'fechaBusqueda' => $fechaBusqueda, 'diferencial' => $diferencial, 'ganancias' => $ganancias]);
    //     }

    //     return view('admin.ventas.index', compact('ventas', 'fechaActual', 'fechaBusqueda'));
    // }

    public function index(Request $request)
    {
        $fechaActual = now()->format('Y-m-d');
        $fechaBusqueda = $request->input('fecha', $fechaActual);

        $ventas = PromoVendidos::whereDate('created_at', $fechaBusqueda)->get();

        if ($request->ajax()) {
            $diferencial = number_format(
                $ventas->sum(function ($venta) {
                    return $venta->costo_real_adul + $venta->costo_real_nini;
                }),
                2,
                '.',
                ','
            );

            $ganancias = number_format($ventas->sum('total'), 2, '.', ',');

            $data = [];

            foreach ($ventas as $venta) {
                $data[] = [
                    'id' => substr($venta->id, 0, 13),
                    'nombre' => $venta->nombre,
                    'correo' => $venta->correo,
                    'cantidad_adultos' => $venta->cantidad_adultos,
                    'cantidad_ninio' => $venta->cantidad_ninio,
                    'total' => number_format($venta->total, 2, '.', ','),
                    'created_at' => $venta->created_at,
                ];
            }

            return response()->json(['ventas' => $data, 'diferencial' => $diferencial, 'ganancias' => $ganancias]);
        }

        return view('admin.ventas.index', compact('ventas', 'fechaActual', 'fechaBusqueda'));
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
            'costo_real_adul' => 'required|integer|min:1',
            'costo_real_nini' => 'required|integer|min:1',
            'cantidad_adultos' => 'required|integer|min:1',
            'cantidad_ninio' => 'required|integer|min:0',
            'nombre_paquete' => 'required|string',
            'fecha_llegada' => 'required|date',
            'fecha_salida' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $nombre_paquete = $request->input('nombre_paquete');
        $telefono = $request->input('telefono');
        $nombre = $request->input('nombre');
        $correo = $request->input('correo');
        $costo_real_adul = $request->input('costo_real_adul');
        $costo_real_nini = $request->input('costo_real_nini');
        $cantidadAdultos = $request->input('cantidad_adultos');
        $cantidadNinios = $request->input('cantidad_ninio', 0);
        $fecha_llegada = $request->input('fecha_llegada');
        $fecha_salida = $request->input('fecha_salida');

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
                'costo_real_adul' => $costo_real_adul,
                'costo_real_nini' => $costo_real_nini,
                'cantidad_adultos' => $cantidadAdultos,
                'cantidad_ninio' => $cantidadNinios,
                'fecha_llegada' => $fecha_llegada,
                'fecha_salida' => $fecha_salida,
                'total' => $total,
            ]);

            $correos = Correos::pluck('email')->toArray();

            $correo_1 = $request->input('correo_1');
            $correo_2 = $request->input('correo_2');

            $correos_1_2 = [$correo_1, $correo_2];

            try {
                Mail::to($correo)->send(new CompraRealizada($compra));
                Mail::to($correos_1_2)->send(new Proveedor($compra));

                foreach ($correos as $correoDestino) {
                    Mail::to($correoDestino)->send(new CorreoAdmin($compra));
                }

                return redirect()->route('comprafinalizada');
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
