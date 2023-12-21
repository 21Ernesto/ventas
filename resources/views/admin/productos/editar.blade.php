<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="w-1/2">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Productos') }}
                </h2>
            </div>
            <div class="w-1/2 text-right">
                <a href="{{ route('productos.index') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    Lista
                </a>

            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto sm:rounded-lg p-5">
                        <form method="POST" action="{{ route('productos.update', ['promociones' => $promocion->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <label for="imagen">Imagen Actual</label>
                            <div>
                                @if ($promocion->imagen)
                                    <img src="{{ asset($promocion->imagen) }}" alt="Imagen actual del paquete"
                                        style="max-width: 200px; max-height: 200px;">
                                @else
                                    <span class="font-semibold pb-7">No hay imagen disponible</span>
                                @endif
                            </div>

                            <label for="imagen">Seleccionar Nueva Imagen</label>
                            <input type="file" name="imagen" class="mb-2 p-2 border rounded w-full"
                                accept="image/*">

                            <label for="nombre_paquete">Nombre del Paquete</label>
                            <input type="text" required name="nombre_paquete" class="mb-2 p-2 border rounded w-full"
                                value="{{ old('nombre_paquete', $promocion->nombre_paquete) }}" />

                            <label for="descripcion_paquete">Descripción del Paquete</label>
                            <textarea required name="descripcion_paquete" class="mb-2 p-2 border rounded w-full">{{ old('descripcion_paquete', $promocion->descripcion_paquete) }}</textarea>

                            {{-- <label for="catindad_dias">Cantidad de Días</label>
                            <input type="number" required name="catindad_dias" class="mb-2 p-2 border rounded w-full"
                                value="{{ old('catindad_dias', $promocion->catindad_dias) }}" /> --}}

                            <label for="costo_adulto">Costo Adulto</label>
                            <input type="number" required name="costo_adulto" class="mb-2 p-2 border rounded w-full"
                                value="{{ old('costo_adulto', $promocion->costo_adulto) }}" />

                            <label for="costo_ninio">Costo Niño</label>
                            <input type="number" required name="costo_ninio" class="mb-2 p-2 border rounded w-full"
                                value="{{ old('costo_ninio', $promocion->costo_ninio) }}" />

                            <label for="promocion" class="flex items-center">
                                <input type="hidden" name="promocion" value="0">
                                <input type="checkbox" name="promocion" value="1" class="form-checkbox mr-2"
                                    {{ $promocion->promocion ? 'checked' : '' }}>
                                <span class="ml-2">Promoción</span>
                            </label>

                            <div class="flex items-center p-4 md:p-5 border-gray-200 rounded-b dark:border-gray-600">
                                <button data-modal-hide="default-modal" type="submit"
                                    class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Editar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




</x-app-layout>
