@extends('layouts/contentNavbarLayout')

@section('title', 'List of Users')

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">User Management /</span> List of Users
</h4>

<!-- Responsive Table -->
<div class="card">
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr class="text-nowrap">
                    <th>#</th>
                    <th>User</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th class="text-center">Is Active?</th>
                    <th>Date Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            <div class="d-flex justify-content-left align-items-center">
                                <div class="avatar-wrapper">
                                    <div class="avatar avatar-sm me-3">
                                        <span class="avatar-initial rounded-circle bg-label-primary"><i class="bx bx-user bx-xs"></i></span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-body text-truncate">
                                        <span class="fw-semibold">{{ $user->last_name . ', ' . $user->first_name }}</span>
                                    </a>
                                    <a href="mailto:{{ $user->email }}" target="_blank"><small class="text-muted">{{ $user->email }}</small></a>
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <span class="text-truncate d-flex align-items-center">
                                <span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2">
                                    <i class="bx bx-cog bx-xs"></i>
                                </span>{{ $user->role }}
                            </span>
                        </td>
                        <td class="text-center">
                            <input class="form-check-input" type="checkbox" disabled {{ $user->is_active ? 'checked' : '' }}>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($user->date_created)->format('M. d, Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--/ Responsive Table -->
@endsection