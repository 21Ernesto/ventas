<x-guest-layout>
    <div class="flex items-center justify-center">
        <h1 class="text-center">
            Te felicitamos, has realizado tu compra con éxito. Revisa tu correo, que ingresaste al realizar la compra,
            se te envió el Váucher de la compra.
        </h1>
    </div>
    <div class="fixed bottom-0 left-0 p-4 bg-white dark:bg-gray-800">
        @php
            $companyName = 'DIM3NSOFT';
            $companyUrl = 'https://dim3nsoft.com.mx/';
        @endphp
    
        <x-info-company :companyName="$companyName" :companyUrl="$companyUrl" />
    </div>
</x-guest-layout>