<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })

    function showSuccessModal() {
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    }
</script>

<script>
    let table = new DataTable('#table', {
        // responsive: true
    });
</script>
<!-- <div id="footer" class="p-3 mt-5 bg-primary fixed-bottom">
    <div class="container text-center mt-5" >
        <p>&copy; 2024 SIM-APK. All rights reserved.</p>
    </div>
</div> -->
</body>
</html>