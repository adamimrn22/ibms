$(document).ready(function () {
    // Spinner container
    const spinnerContainer = $('#roleSpinner');
    spinnerContainer.hide();

    let baseUrl = $('meta[name="base-url"]').attr('content');

    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };

    // Event listener for pagination links
    $(document).on('click', '#Pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let searchTerm = $('#searchUserWithRoles').val();
        let isRole = $('#roleFilter').val();
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(page, searchTerm, isRole, recordsPerPage);
    });

    // Event listener for search input (onkeyup event)
    $(document).on('keyup', '#searchUserWithRoles', function () {
        let searchTerm = $(this).val();
        let isRole = $('#roleFilter').val();
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(1, searchTerm, isRole, recordsPerPage);
    });

    // Event listener for active filter
    $(document).on('change', '#roleFilter', function (e) {
        let isRole = $(this).val();
        let searchTerm = $('#searchInput').val();
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(1, searchTerm, isRole, recordsPerPage);
    });

    // Event listener for record filter
    $(document).on('change', '#recordFilter', function () {
        let recordsPerPage = $(this).val();
        let searchTerm = $('#searchInput').val();
        let isRole = $('#roleFilter').val();
        fetch_data(1, searchTerm, isRole, recordsPerPage);
    });

    // Function to fetch data
    function fetch_data(page, searchTerm = '', isRole = '', recordsPerPage = '') {
        $.ajax({
            url: "/superadmin/permission",
            type: "GET",
            data: {
                page: page,
                search: searchTerm,
                role: isRole,
                records: recordsPerPage
            },
            beforeSend: function () {
                $('#permissionTable').hide();
                spinnerContainer.show();

            },
            success: function (data) {
                spinnerContainer.hide();
                $('#permissionTable').html(data.table).show();
                $('#Pagination').html(data.pagination);
            },
            error: function (xhr) {
                console.log(xhr);
                spinnerContainer.hide();
            }
        });
    }

    $('#unitTable').on('click', '.edit-unit-modal', function () {
        let id = $(this).data('unit-id');
        $('#unitID').val(id)
        let name = $('#modalEditUnitName');

        $.ajax({
            ...ajaxSettings,
            type: "GET",
            url: `${baseUrl}/superadmin/unit/${id}`,
            success: function (response) {

                name.val(response.unit)
            }
        });
    });
});
