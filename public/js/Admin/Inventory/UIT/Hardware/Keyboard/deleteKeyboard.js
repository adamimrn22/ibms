$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#keyboardTable').on('click', '.delete-keyboard-modal', function () {
        let id = $(this).data('keyboard-id');
        $('#deleteID').val(id);
    });

    let deleteKeyboardForm = $('#deleteKeyboardForm');

    deleteKeyboardForm.submit(function (e) {
        e.preventDefault();

        let deleteID = $('#deleteID').val()
        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/UIT/Inventory/Hardware/Keyboard/${deleteID}`,
            success: function (response) {
                $('#keyboardTable').html(response.table).show();
                $('#Pagination').html(response.pagination).show()

                // // Hide the modal
                $('#deleteKeyboardModal').modal('hide');

                // Handle the success response from the server
                toastr.success(response.success, 'Success');
            },
            error: function (xhr) {
                toastr.error(xhr, 'Error');
            }
        });
    });
});
