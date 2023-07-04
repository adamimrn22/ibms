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
        let searchTerm = $('#searchPosition').val();
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(page, searchTerm, recordsPerPage);
    });

    // Event listener for search input (onkeyup event)
    $(document).on('keyup', '#searchPosition', function () {
        let searchTerm = $(this).val();
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(1, searchTerm, recordsPerPage);
    });


    // Event listener for record filter
    $(document).on('change', '#recordFilter', function () {
        let recordsPerPage = $(this).val();
        let searchTerm = $('#searchPosition').val();
        fetch_data(1, searchTerm, recordsPerPage);
    });

    // Function to fetch data
    function fetch_data(page, searchTerm = '', recordsPerPage = '') {
        $.ajax({
            url: `${baseUrl}/position`,
            type: "GET",
            data: {
                page: page,
                search: searchTerm,
                records: recordsPerPage
            },
            beforeSend: function () {
                $('#positionTable').hide();
                spinnerContainer.show();

            },
            success: function (data) {
                spinnerContainer.hide();
                $('#positionTable').html(data.table).show();
                $('#Pagination').html(data.pagination);
            },
            error: function (xhr) {
                spinnerContainer.hide();
            }
        });
    }

    $('#positionTable').on('click', '.edit-position-modal', function () {
        let id = $(this).data('position-id');
        $('#positionID').val(id);
        let name = $('#modalEditPositionName');

        $.ajax({
            ...ajaxSettings,
            type: "GET",
            url: `${baseUrl}/position/${id}`,
            success: function (response) {
                name.val(response.position)
            }
        });
    });
});
