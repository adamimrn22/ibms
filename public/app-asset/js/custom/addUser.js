$(document).ready(function () {

    var AddUserForm = $('#AddUserForm');
    if (AddUserForm.length) {
        AddUserForm.validate({
            rules: {
                addUserID: {
                    required: true,
                    minlength: 5,
                    maxlength: 10
                },
                modalAddUserFirstName: {
                    required: true
                },
                modalAddUserLastName: {
                    required: true
                },
                modalAddUserPhone: {
                    required: true,
                },
                modalAddUserEmail: {
                    required: true,
                    email: true
                }
            },
            messages: {
                addUserID: {
                    required: "Please enter the staff ID",
                    minlength: "The staff ID must be at least 5 characters long",
                    maxlength: "The staff ID cannot exceed 10 characters"
                },
                modalAddUserFirstName: {
                    required: "Please enter the first name"
                },
                modalAddUserLastName: {
                    required: "Please enter the last name"
                },
                modalAddUserPhone: {
                    required: "Please enter a valid phone number"
                },
                modalAddUserEmail: {
                    required: "Please enter a valid email address",
                    email: "Please enter a valid email address"
                }
            },

        });
    }
});
