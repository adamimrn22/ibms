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
                <form id="AddUserForm" class="row gy-1 pt-75" novalidate="novalidate">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label" for="modalAddUserID">STAFF ID</label>
                            <input type="text" id="addUserID" name="addUserID" class="form-control"
                                placeholder="SC0000">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddUserFirstName">First Name</label>
                        <input type="text" id="modalAddUserFirstName" name="modalAddUserFirstName"
                            class="form-control" placeholder="Ahmad" data-msg="Please enter your first name">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddUserLastName">Last Name</label>
                        <input type="text" id="modalAddUserLastName" name="modalAddUserLastName" class="form-control"
                            placeholder="Ronaldo" data-msg="Please enter your last name">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalUserPosition">Staff Poisiton</label>
                        <select id="modalUserPosition" name="modalUserPosition" class="form-select"
                            aria-label="Default select example">

                            <option value="">Loading positions...</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalUserUnit">Staff Unit</label>
                        <select id="modalUserUnit" name="modalUserUnit" class="form-select"
                            aria-label="Default select example">
                            <option value="">Loading positions...</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddUserEmail">Email:</label>
                        <input type="text" id="modalAddUserEmail" name="modalAddUserEmail" class="form-control"
                            placeholder="example@kolejspace.edu.my">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalAddUserPhone">Contact</label>
                        <input type="text" id="modalAddUserPhone" name="modalAddUserPhone"
                            class="form-control phone-number-mask" placeholder="01x-xxx-xxx">
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
