@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Add Account Forms</h4>
    <div class="card p-4">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="admin">admin</option>
                    <option value="operator">operator</option>
                </select>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection