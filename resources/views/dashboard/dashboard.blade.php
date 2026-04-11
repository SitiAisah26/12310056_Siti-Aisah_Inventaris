@extends('layouts.app')

@section('content')

<!-- HEADER BANNER -->
<div class="mb-4 text-white rounded position-relative" 
     style="background: url('https://picsum.photos/1200/300'); background-size: cover; height:200px;">

    <div class="p-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="40">
            <h5 class="mb-0">Welcome, Admin</h5>
        </div>

        <div>
            {{ now()->format('d F Y') }}
        </div>
    </div>

    <!-- INFO BOX -->
    <div class="bg-light text-dark p-3 mx-4 rounded position-absolute w-75" style="bottom:-20px;">
        Check menu in sidebar
    </div>

</div>

<div style="height:40px;"></div>

@endsection