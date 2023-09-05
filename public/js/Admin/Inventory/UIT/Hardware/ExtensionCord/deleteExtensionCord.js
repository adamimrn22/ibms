$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#extensionCordTable').on('click', '.delete-extensioncord-modal', function () {
        let id = $(this).data('extensioncord-id');
        $('#deleteID').val(id);
    });

    let deleteExtensionCordForm = $('#deleteExtensionCordForm');

    deleteExtensionCordForm.submit(function (e) {
        e.preventDefault();

        let deleteID = $('#deleteID').val()
        console.log(deleteID)
        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/UIT/Inventory/Hardware/Extension-cord/${deleteID}`,
            success: function (response) {
                $('#extensionCordTable').html(response.table).show();
                $('#Pagination').html(response.pagination).show()

                // // Hide the modal
                $('#deleteExtensionCordModal').modal('hide');

                // Handle the success response from the server
                toastr.success(response.success, 'Success');
            },
            error: function (xhr) {
                toastr.error(xhr, 'Error');
            }
        });
    });
});
