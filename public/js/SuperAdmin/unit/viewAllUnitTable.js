$(document).ready(function () {
    // Spinner container
    const spinnerContainer = $('#roleSpinner');
    spinnerContainer.hide();

    // Event listener for pagination links
    $(document).on('click', '#Pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let searchTerm = $('#searchUnit').val();
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(page, searchTerm, recordsPerPage);
    });

    // Event listener for search input (onkeyup event)
    $(document).on('keyup', '#searchUnit', function () {
        let searchTerm = $(this).val();
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(1, searchTerm, recordsPerPage);
    });


    // Event listener for record filter
    $(document).on('change', '#recordFilter', function () {
        let recordsPerPage = $(this).val();
        let searchTerm = $('#searchInput').val();
        fetch_data(1, searchTerm, recordsPerPage);
    });

    // Function to fetch data
    function fetch_data(page, searchTerm = '', recordsPerPage = '') {
        $.ajax({
            url: "/superadmin/unit",
            type: "GET",
            data: {
                page: page,
                search: searchTerm,
                records: recordsPerPage
            },
            beforeSend: function () {
                $('#unitTable').hide();
                spinnerContainer.show();

            },
            success: function (data) {
                spinnerContainer.hide();
                $('#unitTable').html(data.table).show();
                $('#Pagination').html(data.pagination);
            },
            error: function (xhr) {
                spinnerContainer.hide();
            }
        });
    }
});
