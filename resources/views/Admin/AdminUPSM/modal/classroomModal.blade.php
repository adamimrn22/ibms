<div class="modal fade" id="addRuangKelas" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Add Ruang Kelas</h1>
                </div>

                <form id="addRuangKelasForm" class="row gy-1 pt-75" onsubmit="return false" novalidate="novalidate">

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" id="className" name="className" class="form-control" placeholder="BK0">
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="classLocation">Location</label>
                        <input type="text" id="classLocation" name="classLocation" class="form-control"
                            placeholder="Tingkat 2" value="Tingkat 2">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="chair">Chair</label>
                        <input type="number" id="classChair" name="classChair" class="form-control" placeholder="1">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="classFoldableChair">Foldable Chair</label>
                        <input type="number" id="classFoldableChair" name="classFoldableChair" class="form-control"
                            placeholder="1">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="classTable">Table</label>
                        <input type="number" id="classTable" name="classTable" class="form-control" placeholder="1">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="classWhiteboard">Whiteboard</label>
                        <input type="number" id="classWhiteboard" name="classWhiteboard" class="form-control"
                            placeholder="1">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="classDuster">Duster</label>
                        <input type="number" id="classDuster" name="classDuster" class="form-control" placeholder="1">
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

<div class="modal fade" id="editRuangKelas" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Edit Ruang Kelas</h1>
                </div>

                <form id="editRuangKelasForm" class="row gy-1 pt-75" onsubmit="return false" novalidate="novalidate">

                    <input type="hidden" id="classID">

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" id="editClassName" name="editClassName" class="form-control"
                            placeholder="BK0">
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="classLocation">Location</label>
                        <input type="text" id="editClassLocation" name="editClassLocation" class="form-control"
                            placeholder="Tingkat 2">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="chair">Chair</label>
                        <input type="number" id="editClassChair" name="editClassChair" class="form-control"
                            placeholder="1">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="classFoldableChair">Foldable Chair</label>
                        <input type="number" id="editClassFoldableChair" name="editClassFoldableChair"
                            class="form-control" placeholder="1">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="classTable">Table</label>
                        <input type="number" id="editClassTable" name="editClassTable" class="form-control"
                            placeholder="1">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="classWhiteboard">Whiteboard</label>
                        <input type="number" id="editClassWhiteboard" name="editClassWhiteboard"
                            class="form-control" placeholder="1">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="classDuster">Duster</label>
                        <input type="number" id="editClassDuster" name="editClassDuster" class="form-control"
                            placeholder="1">
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

<div class="modal fade modal-danger" id="deleteRuangKelas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel120">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="deleteRuangKelasForm">
                <input type="hidden" id="deleteID">
                <div class="modal-body">
                    <span class="text-danger">Warning</span> <br>
                    This action cant be undone
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger waves-effect waves-float waves-light">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>