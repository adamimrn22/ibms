@props(['title'])

<div class="row mt-1">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> {{ $title }}</h3>
            </div>
            <div class="card-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
