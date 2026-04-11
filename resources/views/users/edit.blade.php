@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Account</h4>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- NAME -->
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}">

            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- EMAIL -->
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}">

            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- ROLE -->
        <div class="mb-3">
            <label>Role</label>
            <select name="role"
                class="form-control @error('role') is-invalid @enderror">

                <option value="">Select Role</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>admin</option>
                <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>operator</option>
            </select>

            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- NEW PASSWORD (OPTIONAL) -->
        <div class="mb-3">
            <label>New Password (optional)</label>
            <input type="password" name="password"
                class="form-control @error('password') is-invalid @enderror">

            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- BUTTON -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection