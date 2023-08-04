$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#fileTable').on('click', '.delete-file-modal', function () {
        let id = $(this).data('file-id');
        $('#deleteID').val(id);
    });

    let deleteFileForm = $('#deleteFileForm');

    deleteFileForm.submit(function (e) {
        e.preventDefault();

        let id = $('#deleteID').val();
        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/UKW/Inventory/File/${id}`,
            success: function (response) {
                $('#fileTable').html(response.table).show();
                $('#Pagination').html(response.pagination).show()

                // Handle the success response from the server
                toastr.success(response.success, 'Success');

                // // Hide the modal
                $('#deleteFile').modal('hide');
            },
            error: function (xhr) {
                toastr.error(xhr, 'Error');
            }
        });



    });

})
