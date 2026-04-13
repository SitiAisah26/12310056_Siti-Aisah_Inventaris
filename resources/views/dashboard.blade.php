@extends('layouts.app')

@section('content')

<!-- HEADER BANNER -->
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
<div style="height:40px;"></div>

@endsection

