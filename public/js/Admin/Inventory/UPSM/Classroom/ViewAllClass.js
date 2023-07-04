$('#classroomTable').hide();
$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');

    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };
    let searchTimer;

    // Spinner container
    const spinnerContainer = $('#roleSpinner');
    spinnerContainer.hide();
    $('#classroomTable').show();

    // Event listener for pagination links
    $(document).on('click', '#Pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let searchTerm = $('#searchClassroom').val();
        let userStatus = $('#userFilter').val();
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(page, searchTerm, userStatus, recordsPerPage);
    });

    // Event listener for search input (onkeyup event)
    $(document).on('keyup', '#searchClassroom', function () {
        // Clear the previous timer
        clearTimeout(searchTimer);

        // Start a new timer to delay the AJAX request
        searchTimer = setTimeout(() => {
            let searchTerm = $(this).val();
            let recordsPerPage = $('#recordFilter').val();
            fetch_data(1, searchTerm, recordsPerPage);
        }, 500); // Specify the desired delay in milliseconds (e.g., 500ms)
    });

    // Event listener for record filter
    $(document).on('change', '#recordFilter', function () {
        let recordsPerPage = $(this).val();
        let searchTerm = $('#searchClassroom').val();
        fetch_data(1, searchTerm, recordsPerPage);
    });

    // Function to fetch data
    function fetch_data(page, searchTerm = '', recordsPerPage = '') {
        $.ajax({
            url: `${baseUrl}/Inventory/UPSM/Classroom`,
            type: "GET",
            data: {
                page: page,
                search: searchTerm,
                records: recordsPerPage
            },
            beforeSend: function () {
                $('#classroomTable').hide();
                spinnerContainer.show();

            },
            success: function (data) {
                spinnerContainer.hide();
                $('#classroomTable').html(data.table).show();
                $('#Pagination').html(data.pagination);
            },
            error: function (xhr) {
                spinnerContainer.hide();
            }
        });
    }

});
