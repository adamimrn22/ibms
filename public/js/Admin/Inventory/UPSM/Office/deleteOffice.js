$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('#officeTable').on('click', '.delete-office-modal', function () {
        let id = $(this).data('office-id');
        $('#deleteID').val(id);
    });

    let deleteRuangKelasForm = $('#deleteOfficeForm');

    deleteRuangKelasForm.submit(function (e) {
        e.preventDefault();

        let id = $('#deleteID').val();
        $.ajax({
            ...ajaxSettings,
            type: "DELETE",
            url: `${baseUrl}/Inventory/UPSM/Office/${id}`,
            success: function (response) {
                $('#officeTable').html(response.table).show();
                $('#Pagination').html(response.pagination).show()

                // Handle the success response from the server
                toastr.success(response.success, 'Success');

                // // Hide the modal
                $('#deleteOffice').modal('hide');
            },
            error: function (xhr) {
                toastr.error(xhr, 'Error');
            }
        });



    });

})
