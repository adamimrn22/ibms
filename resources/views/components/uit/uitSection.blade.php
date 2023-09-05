<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Hardware</h4>
                <a href="{{ route('uit.Desktop.index') }}"
                    class="btn btn-outline-primary waves-effect {{ str_contains(request()->path(), 'Hardware') ? 'active' : '' }}">View</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Cable</h4>
                <a href="{{ route('uit.Hdmi.index') }}"
                    class="btn btn-outline-primary waves-effect {{ str_contains(request()->path(), 'Cable') ? 'active' : '' }}">View</a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Others</h4>
                <a href="{{ route('uit.Software.index') }}"
                    class="btn btn-outline-primary waves-effect {{ str_contains(request()->path(), 'Others') ? 'active' : '' }}">View</a>
            </div>
        </div>
    </div>
</div>


<hr>
