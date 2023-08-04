$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#hdmiTable').on('click', '.delete-hdmi-modal', function () {
        let id = $(this).data('hdmi-id');
        $('#deleteID').val(id);
    });

    let deleteHdmiForm = $('#deleteHdmiForm');

    deleteHdmiForm.submit(function (e) {
        e.preventDefault();

        let deleteID = $('#deleteID').val()
        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/UIT/Inventory/Cable/Hdmi/${deleteID}`,
            success: function (response) {
                $('#hdmiTable').html(response.table).show();
                $('#Pagination').html(response.pagination).show()

                // // Hide the modal
                $('#deleteHdmiModal').modal('hide');

                // Handle the success response from the server
                toastr.success(response.success, 'Success');
            },
            error: function (xhr) {
                toastr.error(xhr, 'Error');
            }
        });
    });
});
