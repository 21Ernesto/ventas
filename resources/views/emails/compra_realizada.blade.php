<!-- resources/views/mails/compra-realizada.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Realizada</title>
</head>
<body>
    <p>Hola {{ $compra->nombre }},</p>
    
    <p>¡Gracias por tu compra! Hemos recibido tu pago con éxito.</p>
    
    <!-- Puedes personalizar el contenido del mensaje según tus necesidades -->

    <p>Atentamente,<br>
    Tu tienda en línea</p>
</body>
</html>
