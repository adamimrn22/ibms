<div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <form id="addPermissionForm" class="row" novalidate>
                    <div class="text-center mb-2">
                        <h1 class="mb-1">Add New Permission</h1>
                        <p>Permissions you may use and assign to your users.</p>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="modalPermissionName">Permission Name <span
                                class="text-danger">*</span></label>
                        <input type="text" id="permissionName" name="permissionName" class="form-control"
                            placeholder="Permission Name" autofocus="" data-msg="Please enter permission name">
                        <div class="invalid-feedback"></div>
                    </div>

                    <label class="form-label text-warning mt-2">
                        You also can assign this permission a role
                    </label>

                    <div class="col-12">
                        <div class="mb-1" data-select2-id="91">
                            <div class="position-relative" data-select2-id="90">
                                <label class="form-label" for="default-select-multi">Assign Role</label>
                                <select class="select2 form-select select2-hidden-accessible" multiple=""
                                    id="default-select-multi" data-select2-id="default-select-multi" tabindex="-1"
                                    aria-hidden="true">
                                    <!-- Options will be dynamically populated here -->
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit"
                            class="btn btn-primary mt-2 me-1 waves-effect waves-float waves-light">Create
                            Permission</button>
                        <button type="reset" class="btn btn-outline-secondary mt-2 waves-effect"
                            data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade editPermissionModal" id="editPermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <form id="editPermissionForm" class="row" novalidate>
                    <div class="text-center mb-2">
                        <h1 class="mb-1">Edit Permission</h1>
                    </div>

                    <input type="hidden" id="permissionID">

                    <div class="col-12">
                        <label class="form-label" for="modalPermissionName">Permission Name <span
                                class="text-danger">*</span></label>
                        <input type="text" id="editPermissionName" name="editPermissionName"
                            class="form-control"autofocus="" data-msg="Please enter permission name">
                        <div class="invalid-feedback"></div>
                    </div>

                    <label class="form-label text-warning mt-2">
                        You also can assign this permission a role
                    </label>

                    <div class="col-12">
                        <div class="mb-1" data-select2-id="91">
                            <div class="position-relative" data-select2-id="90">
                                <label class="form-label" for="default-select-multi">Assign Role</label>
                                <select class="select2 form-select select2-hidden-accessible" multiple=""
                                    id="edit-role-multi" data-select2-id="default-select-multi" tabindex="-1"
                                    aria-hidden="true">
                                    <!-- Options will be dynamically populated here -->
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit"
                            class="btn btn-primary mt-2 me-1 waves-effect waves-float waves-light">Create
                            Permission</button>
                        <button type="reset" class="btn btn-outline-secondary mt-2 waves-effect"
                            data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Deleting Permission --}}
<div class="modal fade modal-danger" id="deletePermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel120">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deletePermissionForm">
                <input type="hidden" id="deleteID">
                <div class="modal-body">
                    <span>Are you sure? <br> This will delete the permission and the related roles and user </span>
                    <br>
                    Note: <span class="text-warning">Deleting Permission might break the
                        system</span>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger waves-effect waves-float waves-light">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
