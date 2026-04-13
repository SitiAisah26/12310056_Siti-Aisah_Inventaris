@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Edit Account</h4>
    <div class="card p-4">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
            </div>
            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>admin</option>
                    <option value="operator" {{ $user->role == 'operator' ? 'selected' : '' }}>operator</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('users.admin.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection