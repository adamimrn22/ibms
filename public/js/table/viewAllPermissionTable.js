$(document).ready(function () {
    // Spinner container
    const spinnerContainer = $('#roleSpinner');
    spinnerContainer.hide();

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
                spinnerContainer.hide();
            }
        });
    }
});
