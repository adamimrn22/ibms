<div class="d-flex justify-content-between align-items-baseline mx-0 row mb-1 p-1" id="Pagination">
    <div class="col-sm-12 col-md-6">
        <div role="status" aria-live="polite">Showing
            {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries</div>
    </div>
    <div class="col-sm-12 col-md-6">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end mt-3">
                @if ($data->lastPage() > 1)
                    <li class="page-item {{ $data->currentPage() == 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $data->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">« Prev</span>
                        </a>
                    </li>
                    @for ($i = max(1, $data->currentPage() - 2); $i <= min($data->lastPage(), $data->currentPage() + 2); $i++)
                        <li class="page-item {{ $i == $data->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $data->currentPage() == $data->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $data->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">Next »</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</div>
