<div id="officeTable">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Location</th>
                <th>Details</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $office)
                <tr>
                    <td>
                        {{ $data->firstItem() + $index }}
                    </td>
                    <td>
                        {{ $office->name }}
                    </td>
                    <td>
                        {{ $office->location }}
                    </td>
                    <td>
                        <a href="{{ route('upsm.Office.show', ['Office' => Crypt::encrypt($office->id)]) }}">View</a>
                    </td>

                    <td>
                        <div class="dropdown">
                            <button type="button"
                                class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light"
                                data-bs-toggle="dropdown">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-more-vertical">
                                    <circle cx="12" cy="12" r="1"></circle>
                                    <circle cx="12" cy="5" r="1"></circle>
                                    <circle cx="12" cy="19" r="1"></circle>
                                </svg>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item"
                                    href="{{ route('upsm.Office.edit', ['Office' => Crypt::encrypt($office->id)]) }}">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-edit-2 me-50">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                    <span>Edit</span>

                                </a>

                                <a class="dropdown-item delete-office-modal" href="javascript:void(0);"
                                    data-bs-target="#deleteOffice" data-bs-toggle="modal"
                                    data-office-id="{{ $office->id }}">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-edit-2 me-50">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
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
