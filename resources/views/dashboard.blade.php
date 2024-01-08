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
                                <i class="fas fa-tachometer-alt text-blue-500"></i>
                                <span class="text-blue-500">Dashboard</span>
                            </span>
                        </a>
                    </li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4 flex-auto items-center">

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                        <i class="fas fa-tag text-gray-500 text-7xl"></i>
                        <div class="ms-4">
                            <span class="block text">Promociones</span>
                            <span class="font-bold text-2xl">{{ $totalPromociones }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                        <i class="fas fa-shopping-bag text-gray-500 text-7xl"></i>
                        <div class="ms-4">
                            <span class="block text">Paquetes</span>
                            <span class="font-bold text-2xl">{{ $totalProductos }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                        <i class="fas fa-envelope text-gray-500 text-7xl"></i>
                        <div class="ms-4">
                            <span class="block text">Correos</span>
                            <span class="font-bold text-2xl">{{ $totalCorreos }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                        <i class="fas fa-shopping-cart text-gray-500 text-7xl"></i>
                        <div class="ms-4">
                            <span class="block text">Vendidos</span>
                            <span class="font-bold text-2xl">{{ $totalVendidos }}</span>
                        </div>
                    </div>
                </div>
            </div>

            @if (auth()->user()->role === 'administrador')
                <div class="grid grid-cols-1 gap-4 mb-4 flex-auto items-center">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                            <i class="fas fa-dollar-sign text-green-500 text-7xl"></i>
                            <div class="ms-4">
                                <span class="block text">Ganancias Totales</span>
                                <span class="font-bold text-xl">$ {{ number_format($gananciasTotales, 2, '.', ',') }}</span>

                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
