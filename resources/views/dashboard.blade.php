<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 px-5 mx-auto max-w-7xl">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Primera columna -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                    <i class="fas fa-tag text-gray-500 text-7xl"></i>
                    <div class="ms-4">
                        <span class="block text">Promociones</span>
                        <span class="font-bold text-2xl">{{ $totalPromociones }}</span>
                    </div>
                </div>
            </div>

            <!-- Segunda columna -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                    <i class="fas fa-shopping-bag text-gray-500 text-7xl"></i>
                    <div class="ms-4">
                        <span class="block text">Productos</span>
                        <span class="font-bold text-2xl">{{ $totalProductos }}</span>
                    </div>
                </div>
            </div>

            <!-- Tercera columna -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center">
                    <i class="fas fa-envelope text-gray-500 text-7xl"></i>
                    <div class="ms-4">
                        <span class="block text">Correos</span>
                        <span class="font-bold text-2xl">{{ $totalCorreos }}</span>
                    </div>
                </div>
            </div>

            <!-- Cuarta columna -->
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
    </div>


</x-app-layout>
