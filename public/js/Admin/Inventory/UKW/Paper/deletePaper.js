$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#paperTable').on('click', '.delete-paper-modal', function () {
        let id = $(this).data('paper-id');
        $('#deleteID').val(id);
    });

    let deletePaperForm = $('#deletePaperForm');

    deletePaperForm.submit(function (e) {
        e.preventDefault();

        let id = $('#deleteID').val();
        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/Inventory/UKW/Paper/${id}`,
            success: function (response) {
                $('#paperTable').html(response.table).show();
                $('#Pagination').html(response.pagination).show()

                // Handle the success response from the server
                toastr.success(response.success, 'Success');

                // // Hide the modal
                $('#deletePaper').modal('hide');
            },
            error: function (xhr) {
                toastr.error(xhr, 'Error');
            }
        });



    });

})
