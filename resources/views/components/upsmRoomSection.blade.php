<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ruang Kelas</h4>
                <a href="{{ route('upsm.Classroom.index') }}"
                    class="btn btn-outline-primary waves-effect {{ Request::routeIs('upsm.Classroom.index') ? ' active' : '' }}">View</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ruang Pejabat</h4>
                <a href="{{ route('upsm.Office.index') }}"
                    class="btn btn-outline-primary waves-effect {{ Request::routeIs('upsm.Office.index') ? ' active' : '' }}">View</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Makmal</h4>
                <a href="#" class="btn btn-outline-primary waves-effect">View</a>
            </div>
        </div>
    </div>
</div>
