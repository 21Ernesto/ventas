<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CorreosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromocionesController;
use App\Http\Controllers\PromoVendidosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Rutas públicas que no requieren autenticación
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::post('/promo_producto', [PromoVendidosController::class, 'store'])->name('promo.store');
Route::get('/productos/detalle/{promociones}', [PromocionesController::class, 'show'])->name('productos.show');

Route::get('/comprafinalizada', function () {
    return view('comprafinalizada');
})->name('comprafinalizada');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware(['auth', 'preventBackHistory'])->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/productos', [PromocionesController::class, 'index'])->name('productos.index');
    Route::get('/productos/editar/{promociones}', [PromocionesController::class, 'edit'])->name('productos.edit');
    Route::post('/productos', [PromocionesController::class, 'store'])->name('productos.store');
    Route::patch('/productos/{promociones}', [PromocionesController::class, 'update'])->name('productos.update');
    Route::patch('/productos/{promocion}/activate', [PromocionesController::class, 'activate'])->name('productos.activate');
    Route::patch('/productos/{promocion}/deactivate', [PromocionesController::class, 'deactivate'])->name('productos.deactivate');
    Route::delete('/productos/{promocion}', [PromocionesController::class, 'destroy'])->name('productos.destroy');
    
});

Route::middleware(['auth', 'preventBackHistory', 'checkRole:administrador'])->group(function () {

    Route::get('/correos', [CorreosController::class, 'index'])->name('correos.index');
    Route::get('/correos/editar/{correos}', [CorreosController::class, 'edit'])->name('correos.edit');
    Route::post('/correos', [CorreosController::class, 'store'])->name('correos.store');
    Route::patch('/correos/{correos}', [CorreosController::class, 'update'])->name('correos.update');
    Route::delete('/correos/{correos}', [CorreosController::class, 'destroy'])->name('correos.destroy');

    Route::get('/ventas', [PromoVendidosController::class, 'index'])->name('ventas.index');

    Route::get('/registro', [RegisteredUserController::class, 'index'])->name('registro');
    Route::post('/register-store', [RegisteredUserController::class, 'store'])->name('registro.store');
});

require __DIR__ . '/auth.php';
