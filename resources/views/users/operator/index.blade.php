@extends('layouts.app')

@section('content')
<div class="mb-5 text-white rounded-bottom position-relative shadow-sm" 
     style="background: url('https://picsum.photos/1200/300'); background-size: cover; background-position: center; height:220px;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.4);"></div>

    <div class="h-100 d-flex justify-content-between align-items-center position-relative px-4">
        <div class="d-flex align-items-center gap-3">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" 
                 width="110" 
                 class="img-fluid m-0" 
                 style="filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.3));">
            
            <div class="lh-sm">
                <h3 class="fw-bold mb-0">Welcome Back,</h3>
                <h5 class="mb-0 opacity-75">{{ Auth::user()->role == 'admin' ? 'Admin Wikrama' : 'Operator Wikrama' }}</h5>
            </div>
        </div>

        <div class="fw-bold fs-5">
            {{ now()->format('d F Y') }}
        </div>
    </div>

    <div class="bg-white text-dark p-4 rounded shadow-sm position-absolute" 
         style="bottom: -30px; left: 50%; transform: translateX(-50%); width: 90%; border-left: 5px solid #6f42c1;">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-info-circle-fill text-primary"></i>
            <span>Please check the navigation menu in the sidebar to manage data.</span>
        </div>
    </div>
</div>
<div style="height:5px;"></div>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="mt-0 fs-3">Operator Accounts Table</h1>
        <p class="text-muted">Add, delete, update <span class="text-danger">operator-accounts</span>.</p>
    </div>
    
    <div class="d-flex align-items-center gap-1">
        <a href="{{ route('users.export', ['role' => 'operator']) }}" 
           class="btn shadow-sm px-3 d-flex align-items-center justify-content-center" 
           style="background-color: #6f42c1; color: white; border: none; height: 38px; border-radius: 6px 0 0 6px;">
            <i class="fas fa-file-excel me-2"></i> Export Excel
        </a>
        <a href="{{ route('users.create') }}" 
           class="btn shadow-sm px-3 d-flex align-items-center justify-content-center" 
           style="background-color: #a289d3; color: white; border: none; height: 38px; border-radius: 0 6px 6px 0;">
            <i class="fas fa-plus me-2"></i> Add Operator
        </a>
    </div>
</div>

    @if(session('success'))
        <div class="alert alert-success">Password Baru: {{ session('success') }}</div>
    @endif
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="bg-light">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        <form action="{{ route('users.reset', $user->id) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-warning btn-sm">Reset Password</button>
                        </form>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    
</div>
@endsection