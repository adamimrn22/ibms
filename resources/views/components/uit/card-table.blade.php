@props(['filterID', 'searchPlaceholder', 'addRoute', 'data', 'btnTitle'])

<div class="row mt-1">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <x-uit.hardware-section />
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <x-add-button :title="$btnTitle" :addRoute="$addRoute" />
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-between align-items-center mx-0 mb-2 row">

                <x-uit.filter :id="$filterID" :placeholder="$searchPlaceholder" />

                <div class="col-sm-12 col-md-6">
                    <div class="d-flex justify-content-end">
                        <label class="d-inline-flex  align-items-center">
                            Show
                            <select id="recordFilter" class="form-select mx-1 px-2">
                                <option value="7" selected>7</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="75">75</option>
                                <option value="100">100</option>
                            </select> entries
                        </label>
                    </div>
                </div>
            </div>

            <div class="table-responsive" style="overflow: hidden">
                {{ $slot }}

                <div class="d-flex align-items-center justify-content-center">
                    <div id="roleSpinner" align="center" class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                @include('components.Pagination')
            </div>
        </div>
    </div>
</div>
