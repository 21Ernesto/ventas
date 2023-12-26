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
                                <i class="fas fa-envelope text-blue-500"></i>
                                <span class="text-blue-500">Editar correo</span>
                            </span>
                        </a>
                    </li>
                </ol>
            </nav>

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


@endsection

