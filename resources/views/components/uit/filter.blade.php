@props(['id', 'placeholder'])

<div class="col-sm-12 col-md-4">
    <div class="input-group">
        <button type="button" class="btn btn-outline-primary dropdown-toggle waves-effect" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Filter
        </button>
        <div class="dropdown-menu" style="">
            <select id="statusFilter" class="form-select mx-1 px-2">
                <option value="ALL">All</option>
                <option value="AVAILABLE">Available</option>
                <option value="BOOKED">Booked</option>
                <option value="MISSING">Missing</option>
                <option value="DAMAGED">Damaged</option>
                <option value="DISPOSED">Disposed</option>
            </select>
        </div>
        <input type="text" id="{{ $id }}" placeholder="{{ $placeholder }}" class="form-control">
    </div>
</div>
