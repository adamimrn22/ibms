$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#softwareTable').on('click', '.delete-software-modal', function () {
        let id = $(this).data('software-id');
        $('#deleteID').val(id);
    });

    let deleteSoftwareForm = $('#deleteSoftwareForm');

    deleteSoftwareForm.submit(function (e) {
        e.preventDefault();

        let deleteID = $('#deleteID').val()
        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/UIT/Inventory/Others/Software/${deleteID}`,
            success: function (response) {
                $('#softwareTable').html(response.table).show();
                $('#Pagination').html(response.pagination).show()

                // // Hide the modal
                $('#deleteSoftwareModal').modal('hide');

                // Handle the success response from the server
                toastr.success(response.success, 'Success');
            },
            error: function (xhr) {
                toastr.error(xhr, 'Error');
            }
        });
    });
});
