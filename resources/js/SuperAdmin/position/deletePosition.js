$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');

    let deletePositionForm = $('#deletePositionForm');

    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#positionTable').on('click', '.delete-position-modal', function () {
        let id = $(this).data('position-id')
        $('#deleteID').val(id);
    });

    deletePositionForm.submit(function (e) {
        e.preventDefault();
        let id = $('#deleteID').val();
        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/position/${id}`,
            success: function (response) {
                $('#positionTable').html(response.table);
                $('#Pagination').html(response.pagination);
                // Hide the modal
                $('#deletePositionModal').modal('hide');

                // Handle the success response from the server
                toastr.success(response.success, 'Success');
            },
            error: function (response) {
                toastr.error(response)
            }
        });
    });
});
