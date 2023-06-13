<div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-add-new-role">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5 pb-5">
                <div class="text-center mb-4">
                    <h1 class="role-title">Add New Role</h1>
                    <p>Set role permissions</p>
                </div>
                <!-- Add role form -->
                <form id="addRoleForm" class="row" method="POST">
                    <div class="col-12">
                        <label class="form-label" for="name">Role Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                            placeholder="Enter role name" tabindex="-1" data-msg="Please enter role name">
                        <div class="invalid-feedback" id="name-error"></div>
                    </div>

                    <div class="col-12">
                        <h4 class="mt-2 pt-50">Role Permissions</h4>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody id="addPermissionTableBody">
                                    <!-- Permission checkboxes will be dynamically generated here -->
                                </tbody>
                            </table>
                        </div>
                        <!-- Permission table -->
                    </div>

                    <input type="hidden" id="editRoleId" name="roleId">

                    <div class="col-12 text-center mt-2">
                        <button type="submit"
                            class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal"
                            aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
                <!--/ Add role form -->
            </div>
        </div>
    </div>
</div>

{{-- For Edit Modal  --}}
<div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-edit-role">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5 pb-5">
                <div class="text-center mb-4">
                    <h1 class="role-title">Edit Role</h1>
                    <p>Update role permissions</p>
                </div>
                <!-- Edit role form -->
                <form id="editRoleForm" class="row" method="POST">
                    <div class="col-12">
                        <label class="form-label" for="editName">Role Name</label>
                        <input type="text" id="editName" name="name" class="form-control"
                            placeholder="Enter role name" tabindex="-1" data-msg="Please enter role name">
                        <div class="invalid-feedback" id="editName-error"></div>
                    </div>

                    <div class="col-12">
                        <h4 class="mt-2 pt-50">Role Permissions</h4>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody id="permissionTableBody">
                                    <!-- Permission checkboxes will be dynamically generated here -->
                                </tbody>
                            </table>
                        </div>
                        <!-- Permission table -->
                    </div>

                    <input type="hidden" id="editRoleId" name="roleId">
                    <div class="col-12 text-center mt-2">
                        <button type="submit"
                            class="btn btn-primary me-1 waves-effect waves-float waves-light">Update</button>
                        <button type="button" class="btn btn-danger me-1 waves-effect waves-float waves-light"
                            data-bs-target="#deleteRole" data-bs-toggle="modal" data-bs-dismiss="modal">
                            Delete
                        </button>
                        <button type="reset" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal"
                            aria-label="Close">Discard</button>

                    </div>
                </form>


                <!--/ Edit role form -->
            </div>
        </div>
    </div>
</div>

{{-- For Delete Roles Modal --}}
<div class="modal fade role-delete-modal" id="deleteRole" aria-labelledby="modalToggleLabel2" tabindex="-1"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalToggleLabel2">Are You Sure you want to delete this
                    role?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <form id="deleteModal">
                    <input type="hidden" id="deleteID" name="id">
                    <button class="btn btn-danger waves-effect waves-float waves-light role-delete-modal"
                        id="deleteRoleId" data-bs-toggle="modal" data-bs-target="#deleteRole">
                        Delete
                    </button>
                    <button type="reset" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal"
                        aria-label="Close">Discard</button>

                </form>
            </div>
        </div>
    </div>
</div>
