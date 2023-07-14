$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#desktopTable').on('click', '.delete-desktop-modal', function () {
        let id = $(this).data('desktop-id');
        $('#deleteID').val(id);
    });

    let deleteDesktopForm = $('#deleteDesktopForm');

    deleteDesktopForm.submit(function (e) {
        e.preventDefault();

        let deleteID = $('#deleteID').val()
        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/Inventory/UIT/Hardware/Desktop/${deleteID}`,
            success: function (response) {
                $('#desktopTable').html(response.table).show();
                $('#Pagination').html(response.pagination).show()

                // // Hide the modal
                $('#deleteDesktopModal').modal('hide');

                // Handle the success response from the server
                toastr.success(response.success, 'Success');
            },
            error: function (xhr) {
                toastr.error(xhr, 'Error');
            }
        });
    });
});
