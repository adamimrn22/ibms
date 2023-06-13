$(document).ready(function () {
    var baseUrl = $('meta[name="base-url"]').attr('content');
    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        error: function (xhr) {
            toastr.error('Error', xhr.response);
        }
    };

    $(document).on('click', '.add-permission-modal', function () {
        let url = baseUrl + `/superadmin/permission/lists`;

        $.ajax({
            ...ajaxSettings,
            type: "GET",
            url: url,
            success: function (response) {
                // Clear previous options from the select dropdown
                $('#default-select-multi').empty();

                // Iterate over the roles array and create options
                response.roles.forEach(function (role) {
                    let option = $('<option></option>').attr('value', role.id).text(role.name);
                    $('#default-select-multi').append(option);
                });

                // Initialize select2 after populating the options
                $('#default-select-multi').select2();
            }
        });
    });

});
