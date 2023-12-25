<?php

namespace App\Mail;

use App\Models\PromoVendidos;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CorreoAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $compra; // Cambiado de $nombre a $compra

    // Modificado el constructor para recibir una instancia de PromoVendidos
    public function __construct(PromoVendidos $compra)
    {
        $this->compra = $compra;
    }

    public function build()
    {
        try {
            // Enviar el correo electrónico
            return $this->subject('¡Compra realizada con éxito!')
                ->view('mails.notificacion_admin')
                ->with(['compra' => $this->compra]);
        } catch (\Exception $e) {
            // Manejar cualquier excepción aquí si es necesario
            // Por ejemplo, puedes registrar la excepción en los logs
            Log::error('Error al construir el correo electrónico: ' . $e->getMessage());
        }
    }
}
