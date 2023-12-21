
function toggleDropdown(promocionId) {
    const dropdown = document.getElementById(`dropdown-${promocionId}`);
    const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');

    allDropdowns.forEach((otherDropdown) => {
        if (otherDropdown !== dropdown) {
            otherDropdown.classList.add('hidden');
        }
    });
    dropdown.classList.toggle('hidden');
}


// BUSCAR PRODUCTOS
function search_productos() {
    let input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search_productos");
    filter = input.value.toUpperCase();
    table = document.querySelector("table");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

document.getElementById("search_productos").addEventListener("input", function () {
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



// BUSCAR CORREOS
function search_correos() {
    let input, filter, table, tr, tdName, tdEmail, i, txtValueName, txtValueEmail;
    input = document.getElementById("search_correos");
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

document.getElementById("search_correos").addEventListener("input", function () {
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