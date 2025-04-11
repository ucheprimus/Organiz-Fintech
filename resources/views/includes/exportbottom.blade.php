<script>
    $(document).ready(function () {
        let table = $('#withdrawalTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csv',
                    text: '<i class="fas fa-file-csv"></i> CSV',
                    className: 'btn btn-success'
                },
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    className: 'btn btn-success'
                },
                {
                    extend: 'pdf',
                    text: '<i class="fas fa-file-pdf"></i> PDF',
                    className: 'btn btn-danger'
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Print',
                    className: 'btn btn-primary'
                }
            ]
        });

        // Manually trigger export on button click
        $('#exportBtn').on('click', function () {
            table.button('.buttons-excel').trigger(); // Exports as Excel
        });
    });
</script>
