<div id="mouseTable">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Location</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $mouse)
                <tr>
                    <td>
                        {{ $data->firstItem() + $index }}
                    </td>
                    <td>
                        <a href="{{ route('uit.Mouse.show', ['Mouse' => Crypt::encryptString($mouse->id)]) }}">
                            {{ strtoupper($mouse->name) }}
                        </a>
                    </td>
                    <td>
                        <span class="badge badge-light-primary">
                            {{ $mouse->brand }}</span>
                        </span>
                    </td>
                    <td>
                        {{ $mouse->model }}
                    </td>
                    <td>
                        {{ $mouse->location }}
                    </td>
                    <td>
                        @if ($mouse->status->name === 'AVAILABLE')
                            <span class="badge rounded-pill badge-glow bg-info"> {{ $mouse->status->name }}</span>
                        @elseif ($mouse->status->name === 'BOOKED')
                            <span class="badge rounded-pill badge-glow bg-primary">{{ $mouse->status->name }}</span>
                        @else
                            <span class="badge rounded-pill badge-glow bg-warning">{{ $mouse->status->name }}</span>
                        @endif
                    </td>

                    <td>
                        <div class="dropdown">
                            <button type="button"
                                class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light"
                                data-bs-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-more-vertical">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="12" cy="5" r="1"></circle>
                                    <circle cx="12" cy="19" r="1"></circle>
                                </svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item"
                                    href="{{ route('uit.Mouse.edit', ['Mouse' => Crypt::encryptString($mouse->id)]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-edit-2 me-50">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                    <span>Edit</span>
                                </a>

                                <a class="dropdown-item delete-mouse-modal" href="javascript:void(0);"
                                    data-bs-target="#deleteMouseModal" data-bs-toggle="modal"
                                    data-mouse-id="{{ $mouse->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="feather feather-trash-2 me-50">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    <span>Delete</span>
                                </a>

                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        No Data
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
