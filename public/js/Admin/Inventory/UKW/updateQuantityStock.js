$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');

    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    $('body').on('click', '.btn-update-quantity', function (e) {
        let id = $(this).data('item-id');
        $('#itemAlatTulisID').val(id);
        $('#updateQuantityModal').modal('show');
    });


    $('#updateQuantityModal').on('shown.bs.modal', function (event) {
        // Retrieve the value from the modal
        let id = $('#itemAlatTulisID').val();

        $.ajax({
            ...ajaxSettings,
            type: "GET",
            url: `${baseUrl}/UKW/Inventory/GetAlatTulisQuantityStock/${id}`,
            beforeSend: function () {
                $('#updateBtn').prop('disabled', true);
            },
            success: function (response) {
                $('#quantity').val(response.quantity);
                $('#subcategory').val(response.subcategory);
                $('#updateBtn').prop('disabled', false);
            },
            error: function (xhr) {
                alert('error occured');
                console.error(xhr.responseJSON)
            }
        });
    });

    let quantityModalForm = $('#updateQuantityModalForm');
    if (quantityModalForm.length) {
        quantityModalForm.validate({
            rules: {
                quantity: {
                    required: true,
                    number: true
                },
            },
        });

        quantityModalForm.on('submit', function (event) {
            event.preventDefault(); // Prevent the form from submitting

            let quantity = $('#quantity').val();
            let id = $('#itemAlatTulisID').val();
            let subcategory = $('#subcategory').val();

            $.ajax({
                ...ajaxSettings,
                type: 'POST',
                url: `${baseUrl}/UKW/Inventory/AlatTulisQuantityStock/${id}`, // Replace with your actual route
                data: {
                    quantity: quantity,
                    subcategory: subcategory
                },
                success: function (response) {
                    // Handle the success response here
                    $(`#${response.idTable}`).html(response.table).show();
                    toastr.success(response.success, 'Success');
                    // // Hide the modal
                    $('#updateQuantityModal').modal('hide');
                },
                error: function (xhr, status, error) {
                    // Handle errors here
                    console.error('Request failed', status, error);
                }
            });
        });
    }
});
