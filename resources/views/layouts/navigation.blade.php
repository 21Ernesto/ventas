<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="" class="flex ms-2 md:me-24">
                    <x-application-logo class="h-11 fill-current text-gray-500" />
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button"
                            class="flex items-center justify-center text-2xl h-10 w-10 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-600"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <i class="fas fa-user-circle text-black"></i>
                        </button>


                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">

                            <li>
                                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                                    <i class="fa fa-user-circle"></i>
                                    {{ __('Perfil') }}
                                </x-responsive-nav-link>
                            </li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Cerrar sesión') }}
                                    </x-responsive-nav-link>

                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    <i class="fas fa-tachometer-alt"></i>
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </li>
            <li>
                <x-responsive-nav-link :href="route('productos.index')" :active="request()->routeIs('productos.index')">
                    <i class="fas fa-plane"></i>
                    {{ __('Paquetes') }}
                </x-responsive-nav-link>
            </li>
            <li>
                <x-responsive-nav-link :href="route('correos.index')" :active="request()->routeIs('correos.index')">
                    <i class="fas fa-envelope"></i>
                    {{ __('Correos') }}
                </x-responsive-nav-link>
            </li>
            <li>
                <x-responsive-nav-link :href="route('ventas.index')" :active="request()->routeIs('ventas.index')">
                    <i class="fas fa-chart-line"></i>
                    {{ __('Ventas') }}
                </x-responsive-nav-link>
            </li>
            <li>
                <x-responsive-nav-link :href="route('registro')" :active="request()->routeIs('registro')">
                    <i class="fas fa-user"></i>
                    {{ __('Usuarios') }}
                </x-responsive-nav-link>
            </li>
        </ul>
        <div class="fixed bottom-0 left-0 p-4 bg-white dark:bg-gray-800">
            @php
                $companyName = 'DIM3SOFT';
                $companyUrl = 'https://dim3nsoft.com.mx/';
            @endphp
        
            <x-info-company :companyName="$companyName" :companyUrl="$companyUrl" />
        </div>
        
    </div>
    
</aside>
