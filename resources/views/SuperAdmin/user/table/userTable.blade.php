<div id="userListTable">
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Staff ID</th>
                <th>Name</th>
                <th>Email</th>
                <th class="text-center">Status</th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $user)
                <tr>
                    <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->index + 1 }}</td>
                    <td>
                        {{ $user->username }}
                    </td>
                    <td>
                        {{ $user->first_name . ' ' . $user->last_name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td class="text-center">

                        @if ($user->isActive === 1)
                            <span class="badge rounded-pill badge-light-primary">Active</span>
                        @elseif ($user->isActive === 0)
                            <span class="badge rounded-pill badge-light-dark">Not Active</span>
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
                                <a class="dropdown-item edit-user-modal" href="javascript:void(0);"
                                    data-bs-target="#editUserModal" data-bs-toggle="modal"
                                    data-user-id="{{ $user->id }}">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-edit-2 me-50">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                    <span>Edit</span>

                                </a>

                                <a class="dropdown-item delete-user-modal" href="javascript:void(0);"
                                    data-bs-target="#deleteUserModal" data-bs-toggle="modal"
                                    data-user-id="{{ $user->id }}">

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
