@extends('layouts.app')

@section('main')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">

            <div class="flex justify-between items-center">
                <div class="w-1/2">
                    <nav class="flex mb-5" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a
                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                                    <span class="font-black text-3xl">
                                        <i class="fas fa-plane text-blue-500"></i>
                                        <span class="text-blue-500">Paquetes</span>
                                    </span>
                                </a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="w-1/2 text-right">
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                        <i class="fas fa-plus mr-2"></i> Nuevo
                    </button>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <input type="text" id="search_productos" placeholder="Buscar..." class="border p-2 rounded w-60"
                            oninput="search_productos()">
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2">
                                <tr>
                                    <th scope="col" class="text-center py-3 font-semibold px-4">
                                        Nombre
                                    </th>
                                    <th scope="col" class="text-center py-3 font-semibold px-4">
                                        Imagen
                                    </th>
                                    <th scope="col" class="text-center py-3 font-semibold px-4">
                                        Costo Adulto
                                    </th>
                                    <th scope="col" class="text-center py-3 font-semibold px-4">
                                        Costo Niño
                                    </th>
                                    <th scope="col" class="text-center py-3 font-semibold px-4">
                                        Promoción
                                    </th>
                                    <th scope="col" class="text-center py-3 font-semibold px-4">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($promociones as $promocion)
                                    <tr class="bg-white dark:bg-gray-800 border-b-2">
                                        <td
                                            class="text-center  h-16 font-medium text-gray-900 whitespace-nowrap dark:text-white px-4">
                                            <span>{{ $promocion->nombre_paquete }}</span>
                                        </td>
                                        <td
                                            class="text-center  h-16 font-medium text-gray-900 whitespace-nowrap dark:text-white px-4">
                                            <img src="{{ asset($promocion->imagen) }}" alt="Imagen del paquete"
                                                class="h-12">
                                        </td>
                                        <td
                                            class="text-center  h-16 font-medium text-gray-900 whitespace-nowrap dark:text-white px-4">
                                            <span>$ {{ $promocion->costo_adulto }} MXN</span>
                                        </td>
                                        <td
                                            class="text-center  h-16 font-medium text-gray-900 whitespace-nowrap dark:text-white px-4">
                                            <span>$ {{ $promocion->costo_ninio }} MXN</span>
                                        </td>
                                        <td
                                            class="text-center  h-16 font-medium text-gray-900 whitespace-nowrap dark:text-white px-4">
                                            <span
                                                class="inline-block px-2 py-1 rounded {{ $promocion->promocion ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                                {{ $promocion->promocion ? 'Activa' : 'Inactiva' }}
                                            </span>
                                        </td>
                                        <td class="flex items-center justify-center h-16">
                                            <a href="{{ route('productos.show', $promocion->id) }}" target="_blank"
                                                class="w-5 h-7 border-2 rounded px-4 py-2 text-green-600 flex items-center justify-center border-r">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('productos.edit', $promocion->id) }}"
                                                class="w-5 h-7 border-2 rounded ms-2 px-4 py-2 text-green-600 flex items-center justify-center border-r">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('productos.destroy', $promocion->id) }}"
                                                onsubmit="return confirm('¿Estás seguro?')"
                                                class="w-5 h-7 border-2 rounded ms-2 px-4 py-2 text-red-600 flex items-center justify-center">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="focus:outline-none flex items-center justify-center">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            @if ($promocion->promocion)
                                                <form method="POST"
                                                    action="{{ route('productos.deactivate', $promocion->id) }}"
                                                    class="w-5 h-7 border-2 rounded ms-2 px-4 py-2 text-red-600 flex items-center justify-center">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="focus:outline-none flex items-center justify-center">
                                                        <i class="fas fa-toggle-off"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST"
                                                    action="{{ route('productos.activate', $promocion->id) }}"
                                                    class="w-5 h-7 border-2 rounded ms-2 px-4 py-2 text-red-600 flex items-center justify-center">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="focus:outline-none w-full flex items-center justify-center">
                                                        <i class="fas fa-toggle-on"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-4 text-center text-gray-500 dark:text-gray-400">
                                            No hay productos disponibles.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Nuevo Paquete
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal">
                        <i class="fas fa-times"></i>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
                        @csrf

                        <label for="imagen">Imagen</label>
                        <input type="file" name="imagen" class="mb-2 p-2 border rounded w-full" accept="image/*">

                        <label for="nombre_paquete">Nombre del Paquete</label>
                        <input type="text" required name="nombre_paquete" class="mb-2 p-2 border rounded w-full" />

                        <label for="descripcion_paquete">Descripción del Paquete</label>
                        <textarea required name="descripcion_paquete" class="mb-2 p-2 border rounded w-full"></textarea>


                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
                            <div>
                                <label for="costo_adulto_pro">Costo Adulto (Proveedor)</label>
                                <input type="number" required name="costo_adulto_pro"
                                    class="mb-2 p-2 border rounded w-full" />
                            </div>

                            <div>
                                <label for="costo_ninio_pro">Costo Niño (Proveedor)</label>
                                <input type="number" required name="costo_ninio_pro"
                                    class="mb-2 p-2 border rounded w-full" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
                            <div>
                                <label for="costo_adulto">Costo Adulto (Cliente)</label>
                                <input type="number" required name="costo_adulto"
                                    class="mb-2 p-2 border rounded w-full" />
                            </div>

                            <div>
                                <label for="costo_ninio">Costo Niño (Cliente)</label>
                                <input type="number" required name="costo_ninio"
                                    class="mb-2 p-2 border rounded w-full" />
                            </div>
                        </div>

                        <label for="rango_edad">Rango edad</label>
                        <input type="text" required name="rango_edad" class="mb-2 p-2 border rounded w-full" />

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-2">
                            <div>
                                <label for="correo_1">Correo 1</label>
                                <input type="email" required name="correo_1" class="mb-2 p-2 border rounded w-full" />
                            </div>

                            <div>
                                <label for="correo_2">Correo 2</label>
                                <input type="email" required name="correo_2" class="mb-2 p-2 border rounded w-full" />
                            </div>
                        </div>

                        <div class="flex items-center p-4 md:p-5 border-gray-200 rounded-b dark:border-gray-600">
                            <button data-modal-hide="default-modal" type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>
                            <button data-modal-hide="default-modal" type="button"
                                class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
