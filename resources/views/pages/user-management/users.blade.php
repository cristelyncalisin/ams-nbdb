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
          <th>ID #</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Username</th>
          <th>Role</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
            @forelse($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->last_name . ', ' . $user->first_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <input class="form-check-input" type="checkbox" disabled {{ $user->is_active ? 'checked' : '' }}>
                    </td>
                </tr>
                
            @empty
                <p>No users</p>
            @endforelse
      </tbody>
    </table>
  </div>
</div>
<!--/ Responsive Table -->
@endsection
