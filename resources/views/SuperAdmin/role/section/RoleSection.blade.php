<div id="roleContainer" class="row">
    @foreach ($roles as $role)
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span>Total {{ $role->users->count() }} users</span>
                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                            @foreach ($role->users->take(4) as $user)
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="" class="avatar avatar-sm pull-up"
                                    data-bs-original-title="{{ $user->name }}">
                                    <img class="rounded-circle" src="{{ $user->image }}" alt="Avatar">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                        <div class="role-heading">
                            <h4 class="fw-bolder">{{ $role->name }}</h4>
                            <a href="javascript:void(0);" class="role-edit-modal" data-bs-toggle="modal"
                                data-bs-target="#editRoleModal" data-role-id="{{ $role->id }}">
                                <small class="fw-bolder">Edit Role</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
