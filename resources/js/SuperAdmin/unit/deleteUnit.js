$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');

    let deleteUnitForm = $('#deleteUnitForm');

    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#unitTable').on('click', '.delete-unit-modal', function () {
        let id = $(this).data('unit-id')
        $('#deleteID').val(id);
    });

    deleteUnitForm.submit(function (e) {
        e.preventDefault();
        let id = $('#deleteID').val();

        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/unit/${id}`,
            success: function (response) {
                $('#unitTable').html(response.table);
                $('#Pagination').html(response.pagination);
                // Hide the modal
                $('#deleteUnitModal').modal('hide');

                // Handle the success response from the server
                toastr.success(response.success, 'Success');
            }
        });
    });
});
