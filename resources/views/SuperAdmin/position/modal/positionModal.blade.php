<div class="modal fade" id="addPositionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-Add-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add Unit</h1>
                    <p>Add the unit name in an organization</p>
                </div>
                <form id="addPositionForm" class="row gy-1 pt-75" novalidate>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label" for="modalAddPositionName">Position Name</label>
                            <input type="text" id="modalAddPositionName" name="name" class="form-control"
                                placeholder="Eg: Unit IT">
                            <p class="error text-danger name-error"></p>
                        </div>
                    </div>


                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit"
                            class="btn btn-primary me-1 waves-effect waves-float waves-light">Add</button>
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

<div class="modal fade" id="editPositionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-Add-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Edit Unit</h1>
                    <p>Edit the unit name in an organization</p>
                </div>
                <form id="editPositionForm" class="row gy-1 pt-75" novalidate>
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" id="positionID">
                            <label class="form-label" for="modalEditPositionName">Unit Name</label>
                            <input type="text" id="modalEditPositionName" name="name" class="form-control"
                                placeholder="Eg: Unit IT">
                            <p class="error text-danger name-error"></p>
                        </div>
                    </div>


                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit"
                            class="btn btn-primary me-1 waves-effect waves-float waves-light">Edit</button>
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

{{-- for deleting position --}}
<div class="modal fade modal-danger" id="deletePositionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel120">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deletePositionForm">
                <input type="hidden" id="deleteID">
                <div class="modal-body">
                    <span class="text-danger">Warning</span> <br>
                    This will delete the user position
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger waves-effect waves-float waves-light">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
