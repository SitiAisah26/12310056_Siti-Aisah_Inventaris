@extends('layouts.app')

@section('content')

<div class="container mt-4">
    
    <h4>Edit Account</h4>
    <p>Update user information or change account roles.</p>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}">

            @error('name')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}">

            @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role"
                class="form-control @error('role') is-invalid @enderror">
                <option value="">Select Role</option>
                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>admin</option>
                <option value="operator" {{ old('role', $user->role) == 'operator' ? 'selected' : '' }}>operator</option>
            </select>

            @error('role')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>New Password (optional)</label>
            <input type="password" name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Leave blank if you don't want to change">

            @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-4">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('users.admin.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
    </form>
</div>

@endsection