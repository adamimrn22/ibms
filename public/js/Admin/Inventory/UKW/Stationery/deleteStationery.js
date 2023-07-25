$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#stationeryTable').on('click', '.delete-stationery-modal', function () {
        let id = $(this).data('stationery-id');
        $('#deleteID').val(id);
    });

    let deleteStationeryForm = $('#deleteStationeryForm');

    deleteStationeryForm.submit(function (e) {
        e.preventDefault();

        let id = $('#deleteID').val();
        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/Inventory/UKW/Stationery/${id}`,
            success: function (response) {
                $('#stationeryTable').html(response.table).show();
                $('#Pagination').html(response.pagination).show()

                // Handle the success response from the server
                toastr.success(response.success, 'Success');

                // // Hide the modal
                $('#deleteStationery').modal('hide');
            },
            error: function (xhr) {
                toastr.error(xhr, 'Error');
            }
        });



    });

})
