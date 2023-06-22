$(document).ready(function () {
    let baseUrl = $('meta[name="base-url"]').attr('content');

    const ajaxSettings = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    };
    let searchTimer;
    const addUserForm = $('#AddUserForm');

    // Spinner container
    const spinnerContainer = $('#roleSpinner');
    spinnerContainer.hide();

    // Event listener for pagination links
    $(document).on('click', '#Pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let searchTerm = $('#searchUser').val();
        let userStatus = $('#userFilter').val();
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(page, searchTerm, userStatus, recordsPerPage);
    });

    // Event listener for search input (onkeyup event)
    $(document).on('keyup', '#searchUser', function () {
        // Clear the previous timer
        clearTimeout(searchTimer);

        // Start a new timer to delay the AJAX request
        searchTimer = setTimeout(() => {
            let searchTerm = $(this).val();
            let userStatus = $('#userFilter').val();
            let recordsPerPage = $('#recordFilter').val();
            fetch_data(1, searchTerm, userStatus, recordsPerPage);
        }, 500); // Specify the desired delay in milliseconds (e.g., 500ms)
    });

    // Event listener for active filter
    $(document).on('change', '#userFilter', function (e) {
        let userStatus = $(this).val();
        let searchTerm = $('#searchUser').val();
        let recordsPerPage = $('#recordFilter').val();
        fetch_data(1, searchTerm, userStatus, recordsPerPage);
    });

    // Event listener for record filter
    $(document).on('change', '#recordFilter', function () {
        let recordsPerPage = $(this).val();
        let searchTerm = $('#searchUser').val();
        let userStatus = $('#userFilter').val();
        fetch_data(1, searchTerm, userStatus, recordsPerPage);
    });

    // Function to fetch data
    function fetch_data(page, searchTerm = '', userStatus = '', recordsPerPage = '') {
        $.ajax({
            url: "/users",
            type: "GET",
            data: {
                page: page,
                search: searchTerm,
                status: userStatus,
                records: recordsPerPage
            },
            beforeSend: function () {
                $('#userListRolesTable').hide();
                spinnerContainer.show();

            },
            success: function (data) {
                spinnerContainer.hide();
                $('#userListRolesTable').html(data.table).show();
                console.log(data);
                $('#Pagination').html(data.pagination);
            },
            error: function (xhr) {
                spinnerContainer.hide();
            }
        });
    }

    $('#addUserModal').on('shown.bs.modal', function () {
        let dropdownPosition = $('#modalUserPosition');
        let dropdownUnit = $('#modalUserUnit');

        disableDropdowns(dropdownPosition, dropdownUnit);

        $.ajax({
            ...ajaxSettings,
            type: "GET",
            url: '/users/create',
            success: function (response) {
                populateDropdown(dropdownPosition, response.positions);
                populateDropdown(dropdownUnit, response.unit);

                enableDropdowns(dropdownPosition, dropdownUnit);
            }
        });
    });

    $('#userListTable').on('click', '.edit-user-modal', function () {
        let id = $(this).data('user-id');

        let dropdownPosition = $('#editModalUserPosition');
        let dropdownUnit = $('#editModalUserUnit');

        let editModalUserID = $('#editModalUserID');
        let editModalUserFirstName = $('#editModalUserFirstName');
        let editModalUserLastName = $('#editModalUserLastName');
        let editModalUserEmail = $('#editModalUserEmail');
        let editModalUserPhone = $('#editModalUserPhone');
        let editModalUserStatus = $('#editModalUserStatus');

        disableDropdowns(dropdownPosition, dropdownUnit);

        $.ajax({
            ...ajaxSettings,
            type: "GET",
            url: `/users/${id}`,
            success: function (response) {

                let user = response.user


                $('#userEditName').text(user.first_name + ' ' + user.last_name)
                $('#userID').val(user.id)
                editModalUserID.val(user.username)
                editModalUserFirstName.val(user.first_name);
                editModalUserLastName.val(user.last_name);
                editModalUserEmail.val(user.email);
                editModalUserPhone.val(user.phone_number);
                editModalUserStatus.val(user.isActive);

                let selectedPosition = response.userPositions[1];
                let selectedPositionText = response.userPositions[0];
                let selectedUnit = response.userUnit[1];
                let selectedUnitText = response.userUnit[0];

                populateDropdown(dropdownPosition, response.positions);
                populateDropdown(dropdownUnit, response.units);


                // Select the option and set its text for the selected position
                dropdownPosition.find('option[value="' + selectedPosition + '"]')
                    .prop('selected', true)
                    .text(selectedPositionText);

                // Select the option and set its text for the selected unit
                dropdownUnit.find('option[value="' + selectedUnit + '"]')
                    .prop('selected', true)
                    .text(selectedUnitText);

                enableDropdowns(dropdownPosition, dropdownUnit);
            }
        });
    });


    function disableDropdowns(...dropdowns) {
        dropdowns.forEach(function (dropdown) {
            dropdown.prop('disabled', true);
        });
    }

    function enableDropdowns(...dropdowns) {
        dropdowns.forEach(function (dropdown) {
            dropdown.prop('disabled', false);
            dropdown.find('option[value=""]').remove();
        });
    }

    function populateDropdown(dropdown, options) {
        $.each(options, function () {
            dropdown.append($("<option />").val(this.id).text(this.name));
        });
    }

    addUserForm.submit(function (e) {
        e.preventDefault();
        // let url = baseUrl + `/superadmin/users`;

        let form = {
            staffID: $('#addUserID').val(),
            firstName: $('#modalAddUserFirstName').val(),
            lastName: $('#modalAddUserLastName').val(),
            position: $('#modalUserPosition').val(),
            unit: $('#modalUserUnit').val(),
            email: $('#modalAddUserEmail').val(),
            contact: $('#modalAddUserPhone').val()
        };

        console.log(form)
        $.ajax({
            ...ajaxSettings,
            type: "POST",
            url: "/superadmin/users",
            data: JSON.stringify({ user: form }),
            success: function (response) {
            }
        });
        // $('#addUserModal').hide('modal');
        // $('#addUserModal').find('form')[0].reset();
    });

});
