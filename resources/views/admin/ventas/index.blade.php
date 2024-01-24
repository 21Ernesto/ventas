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
                                <i class="fas fa-chart-line text-blue-500"></i>
                                <span class="text-blue-500">Ventas</span>
                            </span>
                        </a>
                    </li>
                </ol>
            </nav>


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4 flex-auto items-center">
                        <div>
                            <label for="search_ventas">
                                <input type="text" id="search_ventas" placeholder="Buscar..."
                                    class="border p-2 rounded w-full" oninput="search_ventas()">
                            </label>
                        </div>
                        <div>
                            <label for="fecha">
                                <b>Fecha:</b>
                                <input type="date" name="fecha" value="{{ $fechaActual }}" id="fecha"
                                    oninput="searchVentasFecha()">
                            </label>
                        </div>
                        <div>
                            <p>
                                <span><b>Diferencial:</b>
                                    $<span id="diferencial">0.00</span>
                                </span>
                            </p>
                        </div>

                        <div>
                            <p>
                                <span><b>Ganancias:</b>
                                    $<span id="ganancias">0.00</span>
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-semibold">
                                        Folio
                                    </th>
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
                            <tbody id="ventasTableBody">
                                @forelse ($ventas as $venta)
                                    <tr class="bg-white text-center dark:bg-gray-800 dark:border-gray-700 border-b-2">
                                        <td class="p-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ substr($venta->id, 0, 13) }}
                                        </td>
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
                                            $ {{ number_format($venta->total) }}
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
        $(document).ready(function() {
            searchVentasFecha();
        });

        function searchVentasFecha() {
            var fecha = $('#fecha').val();

            $.ajax({
                url: "{{ route('ventas.index') }}",
                type: 'GET',
                data: {
                    fecha: fecha
                },
                success: function(response) {
                    $('#diferencial').text(response.diferencial);
                    $('#ganancias').text(response.ganancias);

                    var ventasTableBody = $('#ventasTableBody');
                    ventasTableBody.empty();

                    $.each(response.ventas, function(index, venta) {
                        var newRow = `
                            <tr class="bg-white text-center dark:bg-gray-800 dark:border-gray-700 border-b-2">
                                <td class="p-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${venta.id.substr(0, 13)}
                                </td>
                                <td class="p-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${venta.nombre}
                                </td>
                                <td class="p-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${venta.correo}
                                </td>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${venta.cantidad_adultos}
                                </td>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${venta.cantidad_ninio}
                                </td>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    $ ${venta.total}
                                </td>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    ${venta.created_at}
                                </td>
                            </tr>
                        `;
                        ventasTableBody.append(newRow);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function search_ventas() {
            let input, filter, table, tr, txtUuid, tdName, tdEmail, i, txtValueName, txtValueEmail, txtValueUuid;
            input = document.getElementById("search_ventas");
            filter = input.value.toUpperCase();
            table = document.querySelector("table");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                txtUuid = tr[i].getElementsByTagName("td")[0];
                tdName = tr[i].getElementsByTagName("td")[1];
                tdEmail = tr[i].getElementsByTagName("td")[2];

                if (tdName && tdEmail && txtUuid) {
                    txtValueName = tdName.textContent || tdName.innerText;
                    txtValueEmail = tdEmail.textContent || tdEmail.innerText;
                    txtValueUuid = txtUuid.textContent || txtUuid.innerText;

                    if (
                        txtValueName.toUpperCase().indexOf(filter) > -1 ||
                        txtValueEmail.toUpperCase().indexOf(filter) > -1 ||
                        txtValueUuid.toUpperCase().indexOf(filter) > -1
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
@endsection
