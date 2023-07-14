@props(['modalID', 'deleteFormId'])

<div class="modal fade modal-danger" id="{{ $modalID }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel120">Are you sure?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="{{ $deleteFormId }}">
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
