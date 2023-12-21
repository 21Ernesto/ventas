<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="w-1/2">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Ventas') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <input type="text" id="search_ventas" placeholder="Buscar..." class="border p-2 rounded w-60"
                            oninput="search_ventas()">
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
                                        Cantidad Adultos
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-semibold">
                                        Cantidad Niños
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-semibold">
                                        Total Compra
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-semibold">
                                        Fecha Compra
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ventas as $venta)
                                    <tr class="bg-white text-center dark:bg-gray-800 dark:border-gray-700 border-b-2">
                                        <td class="p-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $venta->nombre }}
                                        </td>
                                        <td class="p-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $venta->correo }}
                                        </td>
                                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $venta->cantidad_adultos }}
                                        </td>
                                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $venta->cantidad_ninio }}
                                        </td>
                                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $venta->total }}
                                        </td>
                                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $venta->created_at }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-4 text-center text-gray-500 dark:text-gray-400">
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

    <script>
        // BUSCAR CORREOS
        function search_ventas() {
            let input, filter, table, tr, tdName, tdEmail, i, txtValueName, txtValueEmail;
            input = document.getElementById("search_ventas");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tdName = tr[i].getElementsByTagName("td")[0];
                tdEmail = tr[i].getElementsByTagName("td")[1];

                if (tdName && tdEmail) {
                    txtValueName = tdName.textContent || tdName.innerText;
                    txtValueEmail = tdEmail.textContent || tdEmail.innerText;

                    if (
                        txtValueName.toUpperCase().indexOf(filter) > -1 ||
                        txtValueEmail.toUpperCase().indexOf(filter) > -1
                    ) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        document.getElementById("search_ventas").addEventListener("input", function() {
            const query = this.value.trim();

            if (query.length === 0) {
                Array.from(document.querySelectorAll("table tbody tr")).forEach(row => {
                    row.style.display = "";
                });
                return;
            }

            fetch(`/buscar?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    Array.from(document.querySelectorAll("table tbody tr")).forEach(row => {
                        row.style.display = "none";
                    });

                    data.forEach(result => {
                        const row = document.querySelector(`table tbody tr[data-id="${result.id}"]`);
                        if (row) {
                            row.style.display = "";
                        }
                    });
                })
                .catch(error => {
                    console.error('Error al realizar la búsqueda:', error);
                });
        });
    </script>


</x-app-layout>