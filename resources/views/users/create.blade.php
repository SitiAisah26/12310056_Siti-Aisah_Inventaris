@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Add Account Forms</h4>
    <p>Please <span style="color:red">*</span> fill all input form with right value.</p>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <!-- NAME -->
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}">

            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- EMAIL -->
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}">

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
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
                <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>operator</option>
            </select>

            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- BUTTON -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection