</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/datatables.min.js"></script>

<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.0.7/b-3.0.2/b-html5-3.0.2/b-print-3.0.2/sc-2.4.2/datatables.min.js"></script>

<!-- script buat modal -->
<script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })

</script>

<!-- script buat JQuery -->
<script>
    $(document).ready(function() {
    $('#table_main').DataTable({
        lengthMenu: [5, 10, 15, 20, 25, 100],
        pageLength: 5,
                buttons: [
                    {
                        extend: 'copy',
                        text: '<i class="fa-regular fa-copy"></i> Salin', // Mengubah nama tombol
                        className: 'btn btn-primary' // Mengubah warna tombol
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fa-regular fa-file-excel"></i> Unduh Excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="fa-regular fa-file-pdf""></i> Unduh PDF',
                        className: 'btn btn-danger'
                    }
                ],
        layout: {
            top2End: 'search',
            topEnd: 'buttons'
        },
        language: {
                    lengthMenu: 'Tampilkan _MENU_ entri',
                    search: 'Cari:',
                    info: "Table dari _START_ ke _END_ dari _TOTAL_ entri",

                    paginate: {
                        first: 'first',
                        last: 'end',
                        next: '>',
                        previous: '<'
                    },
                    zeroRecords: 'Data yang dicari tidak tersedia',
                    searchPlaceholder: 'Cari Disini'
                }    });
    $('#table_modal').DataTable({
        lengthMenu: [5, 10, 15, 20, 25, 100],
        pageLength: 5,

        language: {
            "infoFiltered":   ""
                }    
        });
    });
</script>

<script>
    function togglePassword(id) {
        var password = document.getElementById("password" + id);
        var passwordPlain = document.getElementById("password_plain" + id);
        var button = event.target;

        if (password.style.display === "none") {
            password.style.display = "inline";
            passwordPlain.style.display = "none";
            button.classList.remove("fa-eye-slash");
            button.classList.add("fa-eye");
        } else {
            password.style.display = "none";
            passwordPlain.style.display = "inline";
            button.classList.remove("fa-eye");
            button.classList.add("fa-eye-slash");
        }
    }
</script>


<div id="footer" class="p-2 bg-primary">
    <div class="container text-center mt-5" >
        <p>&copy; 2024 SIM-APK. All rights reserved.</p>
    </div>
</div>

</body>
</html>