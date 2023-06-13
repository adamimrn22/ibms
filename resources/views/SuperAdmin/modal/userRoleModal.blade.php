<div class="modal fade" id="addUserPermissionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-add-new-role">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5 pb-5">
                <div class="text-center mb-4">
                    <h1 class="role-title">User Permission</h1>
                    <p id="userPermissionName"> </p>
                </div>
                <!-- Add role form -->
                <form id="addPermissionForm" class="row justify-content-center" method="POST">
                    <div class="col-8 ">
                        <h4 class="mt-2 pt-50">Role Permissions</h4>
                        <!-- Permission table -->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody id="addUserPermissionTableBody">
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
