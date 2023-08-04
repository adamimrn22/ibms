$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#projectorTable').on('click', '.delete-projector-modal', function () {
        let id = $(this).data('projector-id');
        $('#deleteID').val(id);
    });

    let deleteProjectorForm = $('#deleteProjectorForm');

    deleteProjectorForm.submit(function (e) {
        e.preventDefault();

        let deleteID = $('#deleteID').val()
        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/UIT/Inventory/Hardware/Projector/${deleteID}`,
            success: function (response) {
                $('#projectorTable').html(response.table).show();
                $('#Pagination').html(response.pagination).show()

                // // Hide the modal
                $('#deleteProjectorModal').modal('hide');

                // Handle the success response from the server
                toastr.success(response.success, 'Success');
            },
            error: function (xhr) {
                toastr.error(xhr, 'Error');
            }
        });
    });
});
