<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-Add-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add User</h1>
                    <p>Add the staff information credentials.</p>
                </div>
                <form id="AddUserForm" class="row gy-1 pt-75" novalidate>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label" for="modalAddUserID">STAFF ID</label>
                            <input type="text" id="addUserID" name="addUserID" class="form-control text-uppercase"
                                placeholder="SC0000">
                            <p class="error text-danger username-error"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddUserFirstName">First Name</label>
                        <input type="text" id="modalAddUserFirstName" name="modalAddUserFirstName"
                            class="form-control text-uppercase" placeholder="John"
                            data-msg="Please enter your first name">
                        <p class="error text-danger first_name-error"></p>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddUserLastName">Last Name</label>
                        <input type="text" id="modalAddUserLastName" name="modalAddUserLastName"
                            class="form-control text-uppercase" placeholder="Doe"
                            data-msg="Please enter your last name">
                        <p class="error text-danger last_name-error"></p>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalUserPosition">Staff Poisiton</label>
                        <select id="modalUserPosition" name="modalUserPosition" class="form-select text-uppercase"
                            aria-label="Default select example">

                            <option value="">Loading positions...</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalUserUnit">Staff Unit</label>
                        <select id="modalUserUnit" name="modalUserUnit" class="form-select text-uppercase"
                            aria-label="Default select example">
                            <option value="">Loading positions...</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddUserEmail">Email:</label>
                        <input type="text" id="modalAddUserEmail" name="modalAddUserEmail" class="form-control"
                            placeholder="example@kolejspace.edu.my">

                        <p class="error text-danger email-error"></p>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddUserPhone">Contact</label>
                        <input type="text" id="modalAddUserPhone" name="modalAddUserPhone"
                            class="form-control phone-number-mask" placeholder="01x-xxx-xxx">
                        <p class="error text-danger phone_number-error"></p>
                    </div>


                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit"
                            class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal"
                            aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-Add-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Edit User</h1>
                    <p id="userEditName"></p>
                </div>
                <form id="editUserForm" class="row gy-1 pt-75" novalidate>
                    <div class="col-12 col-md-6">
                        <input type="hidden" id="userID">
                        <label class="form-label" for="editModalUserID">STAFF ID</label>
                        <input type="text" id="editModalUserID" name="editModalUserID" class="form-control "
                            placeholder="SC0000" readonly>
                        <p class="error text-danger username-error"></p>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="editModalUserStatus">User Status</label>
                        <select id="editModalUserStatus" name="editModalUserStatus" class="form-select"
                            aria-label="Default select example">
                            <option value="1">Active</option>
                            <option value="0">Not Active</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="editModalUserFirstName">First Name</label>
                        <input type="text" id="editModalUserFirstName" name="editModalUserFirstName"
                            class="form-control" placeholder="John" data-msg="Please enter your first name">
                        <p class="error text-danger first_name-error"></p>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="editModalUserLastName">Last Name</label>
                        <input type="text" id="editModalUserLastName" name="editModalUserLastName"
                            class="form-control" placeholder="Doe" data-msg="Please enter your last name">
                        <p class="error text-danger last_name-error"></p>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="editModalUserPosition">Staff Poisiton</label>
                        <select id="editModalUserPosition" name="editModalUserPosition" class="form-select"
                            aria-label="Default select example">

                            <option value="">Loading positions...</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="editModalUserUnit">Staff Unit</label>
                        <select id="editModalUserUnit" name="editModalUserUnit" class="form-select"
                            aria-label="Default select example">
                            <option value="">Loading positions...</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="editModalUserEmail">Email:</label>
                        <input type="text" id="editModalUserEmail" name="editModalUserEmail" class="form-control"
                            placeholder="example@kolejspace.edu.my">

                        <p class="error text-danger email-error"></p>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="editModalUserPhone">Contact</label>
                        <input type="text" id="editModalUserPhone" name="editModalUserPhone"
                            class="form-control phone-number-mask" placeholder="01x-xxx-xxx">
                        <p class="error text-danger phone_number-error"></p>
                    </div>

                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit"
                            class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal"
                            aria-label="Close">
                            Discard
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

{{-- for deleting user --}}
<div class="modal fade modal-danger" id="deleteUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel120">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteUserForm">
                <input type="hidden" id="deleteID">
                <div class="modal-body">
                    <span class="text-danger">Warning</span> <br>
                    This will delete the user and all of the records assign to this user
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger waves-effect waves-float waves-light">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
