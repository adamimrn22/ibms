$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#miscTable').on('click', '.delete-misc-modal', function () {
        let id = $(this).data('misc-id');
        $('#deleteID').val(id);
    });

    let deleteMiscForm = $('#deleteMiscForm');

    deleteMiscForm.submit(function (e) {
        e.preventDefault();

        let deleteID = $('#deleteID').val()
        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/UIT/Inventory/Others/Miscellaneous/${deleteID}`,
            success: function (response) {
                $('#miscTable').html(response.table).show();
                $('#Pagination').html(response.pagination).show()

                // // Hide the modal
                $('#deleteMiscModal').modal('hide');

                // Handle the success response from the server
                toastr.success(response.success, 'Success');
            },
            error: function (xhr) {
                toastr.error(xhr, 'Error');
            }
        });
    });
});
