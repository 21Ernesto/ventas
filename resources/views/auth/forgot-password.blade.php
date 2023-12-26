<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('¿Olvidaste tu contraseña? No hay problema. Solo indícanos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña, permitiéndote elegir una nueva.') }}
    </div>

    <!-- Estado de la Sesión -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Dirección de Correo Electrónico -->
        <div>
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Enviar Enlace para Restablecer Contraseña por Correo Electrónico') }}
            </x-primary-button>
        </div>
    </form>
    <div>
        @php
            $companyName = 'DIM3NSOFT';
            $companyUrl = 'https://dim3nsoft.com.mx/';
        @endphp

        <x-info-company :companyName="$companyName" :companyUrl="$companyUrl" />
    </div>
</x-guest-layout>
