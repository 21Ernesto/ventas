<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="w-1/2">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Correos') }}
                </h2>
            </div>
            <div class="w-1/2 text-right">
                <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    <i class="fas fa-plus mr-2"></i> Nuevo
                </button>

            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <input type="text" id="search_correos" placeholder="Buscar..."
                            class="border p-2 rounded w-60" oninput="search_correos()">
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-semibold">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-semibold">
                                        Correo
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-semibold">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($correos as $correos)
                                    <tr class="bg-white text-center dark:bg-gray-800 dark:border-gray-700 border-b-2">
                                        <td class="p-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <span>{{ $correos->nombre }}</span>
                                        </td>
                                        <td class="p-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <span>{{ $correos->email }}</span>
                                        </td>
                                        <td class="relative">
                                            <button
                                                class="h-10 w-10 bg-gray-400 rounded text-gray-50 hover:text-gray-800 focus:outline-none"
                                                onclick="toggleDropdown('{{ $correos->id }}')">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>

                                            <div id="dropdown-{{ $correos->id }}"
                                                class="absolute right-0 mt-2 bg-white border dark:border-gray-700 rounded-md shadow-md hidden"
                                                style="z-index: 1000;">

                                                <a href="{{ route('correos.edit', $correos->id) }}"
                                                    class="block w-full px-4 py-2 text-green-600 hover:bg-gray-100">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form method="POST"
                                                    action="{{ route('correos.destroy', $correos->id) }}"
                                                    onsubmit="return confirm('¿Estás seguro?')"
                                                    class="block w-full px-4 py-2 text-red-600 hover:bg-gray-100">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full focus:outline-none">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-4 text-center text-gray-500 dark:text-gray-400">
                                            No hay correos disponibles.
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
                        Nuevo Correo
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal">
                        <i class="fas fa-times"></i>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <form method="POST" action="{{ route('correos.store') }}" enctype="multipart/form-data">
                        @csrf

                        <label for="nombre">Nombre </label>
                        <input type="text" required name="nombre" class="mb-2 p-2 border rounded w-full"
                            value="" />


                        <label for="email">Email </label>
                        <input type="email" required name="email" class="mb-2 p-2 border rounded w-full"
                            value="" />

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


</x-app-layout>
