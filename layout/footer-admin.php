<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/datatables.min.js"></script>

<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.0.7/b-3.0.2/b-html5-3.0.2/b-print-3.0.2/sc-2.4.2/datatables.min.js"></script>
<script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })

</script>

<script>
    let table = new DataTable('#table', {
        lengthMenu: [5, 10, 15, 20, 25, 100],
        pageLength: 5,
                buttons: [
                    {
                        extend: 'copy',
                        text: 'Salin', // Mengubah nama tombol
                        className: 'btn btn-primary' // Mengubah warna tombol
                    },
                    {
                        extend: 'excel',
                        text: 'Unduh Excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdf',
                        text: 'Unduh PDF',
                        className: 'btn btn-danger'
                    }
                ],
        layout: {
            topEnd: 'buttons'
        }

    }   
    );
</script>
<!-- <div id="footer" class="p-3 mt-5 bg-primary fixed-bottom">
    <div class="container text-center mt-5" >
        <p>&copy; 2024 SIM-APK. All rights reserved.</p>
    </div>
</div> -->
</body>
</html>