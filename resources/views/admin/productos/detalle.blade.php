@extends('layouts.detalle')

@section('main')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Primera Columna - Descripción del Producto -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg p-5">
                    <div class="">
                        <h1 class="text-3xl font-semibold mb-4">{{ $promocion->nombre_paquete }}</h1>
                    </div>

                    @if ($promocion->imagen)
                        <img src="{{ asset($promocion->imagen) }}" alt="Imagen actual del paquete" class="w-full h-96">
                    @else
                        <span class="font-semibold pb-7">No hay imagen disponible</span>
                    @endif

                    <p class="text-base mb-4 mt-3">{{ $promocion->descripcion_paquete }}</p>
                    <p class="text-base mb-4"><span class="font-semibold">Costo Adulto:</span> $
                        {{ $promocion->costo_adulto }}</p>
                    <p class="text-base mb-4"><span class="font-semibold">Costo Niño:</span> $ {{ $promocion->costo_ninio }}
                    </p>

                    @if ($promocion->promocion)
                        <div class="text-center">
                            <p class="text-2xl mb-4 text-green-500 font-semibold animate-pulse">¡Promoción disponible!</p>
                        </div>
                    @endif
                </div>

                <!-- Segunda Columna - Formulario de Compra -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg p-5">
                    <div class="mb-4 text-center">
                        <h1 class="font-black text-4xl">Realizando compra</h1>
                    </div>
                    <div class="mb-4 text-center">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-32 h-36 mx-auto mb-2">
                    </div>
                    <form action="{{ route('promo.store') }}" method="POST" id="compraForm" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="nombre_paquete" value="{{ $promocion->nombre_paquete }}">
                        <input type="hidden" name="costo_adulto" value="{{ $promocion->costo_adulto }}">
                        <input type="hidden" name="costo_ninio" value="{{ $promocion->costo_ninio }}">
                        <input type="hidden" name="es_promocion" value="{{ $promocion->promocion ? 'true' : 'false' }}">


                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div class="mb-4">
                                <label for="nombre" class="block text-sm font-semibold text-gray-600">Nombres:</label>
                                <input type="text" id="nombre" name="nombre" required
                                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                            </div>
                            <div class="mb-4">
                                <label for="telefono" class="block text-sm font-semibold text-gray-600">Teléfono:</label>
                                <input type="text" id="telefono" name="telefono" required
                                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="correo" class="block text-sm font-semibold text-gray-600">Correo
                                electrónico:</label>
                            <input type="email" id="correo" name="correo" required
                                class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                            <!-- Nota -->
                            <p class="text-sm text-gray-500 mt-1">Ingrese una dirección de correo electrónico válida.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <!-- Cantidad de Adultos -->
                            <div>
                                <label for="cantidad_adultos" class="block text-sm font-semibold text-gray-600">Cantidad de
                                    Adultos:</label>
                                <input type="number" id="cantidad_adultos" name="cantidad_adultos" value="0"
                                    min="1" required
                                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                            </div>

                            <!-- Cantidad de Niños -->
                            <div>
                                <label for="cantidad_ninio" class="block text-sm font-semibold text-gray-600">Cantidad de
                                    Niños:</label>
                                <input type="number" id="cantidad_ninio" name="cantidad_ninio" value="0"
                                    min="0" required
                                    class="mt-1 p-2 w-full border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap mb-4 flex-col items-center h-full">
                            <div>
                                <p id="total" class="text-base font-semibold mt-4">Total: 0</p>
                            </div>

                            <!-- Elemento de Stripe para la entrada de tarjeta -->
                            <div id="card-element"
                                class="p-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"></div>

                            <!-- Usado para mostrar errores de Stripe -->
                            <div id="card-errors" role="alert" class="text-red-500"></div>

                            <!-- Botón de pago -->
                            <button id="submit-button"
                                class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring focus:border-blue-300">
                                Realizar Compra
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        const cantidadAdultosInput = document.getElementById('cantidad_adultos');
        const cantidadNiniosInput = document.getElementById('cantidad_ninio');
        const totalElement = document.getElementById('total');

        const costoAdultoValue = parseFloat("{{ $promocion->costo_adulto }}");
        const costoNinioValue = parseFloat("{{ $promocion->costo_ninio }}");
        const esPromocion = parseInt("{{ $promocion->promocion }}"); // Convertir a entero

        cantidadAdultosInput.addEventListener('input', calcularTotal);
        cantidadNiniosInput.addEventListener('input', calcularTotal);

        function calcularTotal() {
            const cantidadAdultos = parseInt(cantidadAdultosInput.value) || 0;
            const cantidadNinios = parseInt(cantidadNiniosInput.value) || 0;

            let total;

            // Ajustar el cálculo si es una promoción "dos por uno"
            if (esPromocion) {
                total = Math.ceil((costoAdultoValue * cantidadAdultos + costoNinioValue * cantidadNinios) / 2);
            } else {
                total = costoAdultoValue * cantidadAdultos + costoNinioValue * cantidadNinios;
            }

            // Mostrar el total
            if (totalElement) {
                totalElement.textContent = 'Total: $' + total.toFixed(2);
            }
        }




        var stripe = Stripe("{{ config('services.stripe.key') }}");
        var elements = stripe.elements();

        // Configurar el estilo del elemento de tarjeta para que coincida con el diseño de tu formulario
        var style = {
            base: {
                color: '#32325d',
                fontFamily: 'Arial, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                },
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a',
            },
        };

        var card = elements.create('card', {
            style: style
        });

        // Agregar el elemento de tarjeta al formulario
        card.mount('#card-element');

        // Manejar cambios en el elemento de tarjeta para mostrar errores en tiempo real
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Manejar la submisión del formulario
        var form = document.getElementById('compraForm');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Mostrar errores de Stripe al usuario
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Agregar el token de tarjeta como un campo oculto al formulario
                    var tokenInput = document.createElement('input');
                    tokenInput.setAttribute('type', 'hidden');
                    tokenInput.setAttribute('name', 'stripeToken');
                    tokenInput.setAttribute('value', result.token.id);
                    form.appendChild(tokenInput);

                    // Enviar el formulario con el token de tarjeta
                    form.submit();
                }
            });
        });
    </script>
@endsection
