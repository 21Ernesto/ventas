@extends('layouts.app')

@section('main')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">

            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <span class="font-black text-3xl">
                                <i class="fas fa-plane text-blue-500"></i>
                                <span class="text-blue-500">Editar paquetes</span>
                            </span>
                        </a>
                    </li>
                </ol>
            </nav>

            <div class="bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto sm:rounded-lg p-5">
                        <form method="POST" action="{{ route('productos.update', ['promociones' => $promocion->id]) }}"
                            enctype="multipart/form-data">
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
                            <input type="file" name="imagen" class="mb-2 p-2 border rounded w-full" accept="image/*">

                            <label for="nombre_paquete">Nombre del Paquete</label>
                            <input type="text" required name="nombre_paquete" class="mb-2 p-2 border rounded w-full"
                                value="{{ old('nombre_paquete', $promocion->nombre_paquete) }}" />

                            <label for="descripcion_paquete">Descripción del Paquete</label>
                            <textarea required name="descripcion_paquete" class="mb-2 p-2 border rounded w-full">{{ old('descripcion_paquete', $promocion->descripcion_paquete) }}</textarea>


                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
                                <div>
                                    <label for="costo_adulto_pro">Costo Adulto (Proveedor)</label>
                                    <input type="number" required name="costo_adulto_pro"
                                        class="mb-2 p-2 border rounded w-full" value="{{ old('costo_ninio', $promocion->costo_adulto_pro) }}" />
                                </div>

                                <div>
                                    <label for="costo_ninio_pro">Costo Niño (Proveedor)</label>
                                    <input type="number" required name="costo_ninio_pro"
                                        class="mb-2 p-2 border rounded w-full" value="{{ old('costo_ninio', $promocion->costo_ninio_pro) }}" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
                                <div>
                                    <label for="costo_adulto">Costo Adulto (Cliente)</label>
                                    <input type="number" required name="costo_adulto"
                                        class="mb-2 p-2 border rounded w-full"
                                        value="{{ old('costo_ninio', $promocion->costo_adulto) }}" />
                                </div>

                                <div>
                                    <label for="costo_ninio">Costo Niño (Proveedor)</label>
                                    <input type="number" required name="costo_ninio" class="mb-2 p-2 border rounded w-full"
                                        value="{{ old('costo_ninio', $promocion->costo_ninio) }}" />
                                </div>
                            </div>

                            <label for="rango_edad">Rango edad</label>
                            <input type="text" required name="rango_edad" class="mb-2 p-2 border rounded w-full" 
                            value="{{ old('costo_ninio', $promocion->rango_edad) }}"/>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
                                <div>
                                    <label for="correo_1">Correo 1</label>
                                    <input type="email" required name="correo_1" class="mb-2 p-2 border rounded w-full" 
                                    value="{{ old('costo_ninio', $promocion->correo_1) }}" />
                                </div>

                                <div>
                                    <label for="correo_2">Correo 2</label>
                                    <input type="email" required name="correo_2" class="mb-2 p-2 border rounded w-full" 
                                    value="{{ old('costo_ninio', $promocion->correo_2) }}"/>
                                </div>
                            </div>

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
@endsection
