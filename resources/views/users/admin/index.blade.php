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

<div class="container-fluid px-4 mt-5">
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" style="background-color: #d1f7ec; color: #008a61;">
            <i class="fas fa-check-circle me-2"></i> Akun berhasil dibuat! <br>
            <strong>Password: {{ session('success') }}</strong>
            <p class="small mb-0">Simpan password ini karena tidak akan muncul lagi!</p>
        </div>
    @endif

    <h1 class="mt-4">Admin Users</h1>
<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-muted">Manage system <span class="text-danger">.admin_accounts</span></p>
    
    <div class="d-flex align-items-center gap-1">
        <a href="{{ route('users.export', ['role' => 'admin']) }}" 
           class="btn shadow-sm px-3 d-flex align-items-center justify-content-center" 
           style="background-color: #6f42c1; color: white; border: none; height: 38px;">
            <i class="fas fa-file-excel me-2"></i> Export Excel
        </a>
        <a href="{{ route('users.create') }}" 
           class="btn shadow-sm px-3 d-flex align-items-center justify-content-center" 
           style="background-color: #a289d3; color: white; border: none; height: 38px;">
            <i class="fas fa-plus me-2"></i> Add Admin
        </a>
    </div>
</div>

    <table class="table table-bordered bg-white shadow-sm">
        <thead class="table-light">
            <tr class="text-center">
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="text-center">
                    <span class="badge bg-primary px-3">
                        {{ $user->role }}
                    </span>
                </td>
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">
                        <a href="/users/{{ $user->id }}/edit" class="btn btn-primary btn-sm" style="background-color: #6f42c1; border: none;">Edit</a>
                        
                        <form action="/users/{{ $user->id }}" method="POST" style="display:inline;"">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection