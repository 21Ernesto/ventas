<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="w-1/2">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Correos') }}
                </h2>
            </div>
            <div class="w-1/2 text-right">
                <a href="{{ route('correos.index') }}"
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
                        <form method="POST" action="{{ route('correos.update', ['correos' => $correos->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <label for="nombre">Nombre </label>
                            <input type="text" required name="nombre" class="mb-2 p-2 border rounded w-full"
                                value="{{ old('nombre', $correos->nombre) }}" />

                            
                            <label for="email">Email </label>
                            <input type="email" required name="email" class="mb-2 p-2 border rounded w-full"
                                value="{{ old('email', $correos->email) }}" />


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
