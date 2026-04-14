@extends('layouts.app')

@section('content')
    <div class="mb-5 text-white rounded-bottom position-relative shadow-sm"
        style="background: url('https://picsum.photos/1200/300'); background-size: cover; background-position: center; height:220px;">

        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.4);"></div>

        <div class="h-100 d-flex justify-content-between align-items-center position-relative px-4">
            <div class="d-flex align-items-center gap-3">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="110" class="img-fluid m-0"
                    style="filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.3));">

                <div class="lh-sm">
                    <h3 class="fw-bold mb-0">Welcome Back,</h3>
                    <h5 class="mb-0 opacity-75">{{ Auth::user()->role == 'admin' ? 'Admin Wikrama' : 'Operator Wikrama' }}
                    </h5>
                </div>
            </div>

            <div class="fw-bold fs-5">
                {{ now()->format('F d, Y') }}
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

    {{-- content--}}
    <div class="container-fluid px-4">
        <h1 class="mt-4">Lending Table</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="text-muted">Data of <span class="text-danger">.lendings</span></p>
            
            <a href="{{ route('items.index') }}" class="btn shadow-sm px-3" 
               style="background-color: #6f42c1; color: white; border: none; border-radius: 6px;">
               <i class="fas fa-arrow-left me-2"></i> Back
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered bg-white shadow-sm">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Item</th>
                        <th>Name</th>
                        <th>Ket.</th>
                        <th>Date</th>
                        <th>Returned</th>
                        <th>Edited By</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lendings as $l)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $l->name }}</td>
                            <td>{{ $l->notes ?? '-' }}</td>

                            {{-- ✅ FIX DISINI (DATE + TIME) --}}
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($l->date_time)->format('d F Y H:i') }}
                                @if($l->is_returned)
                                    - {{ \Carbon\Carbon::parse($l->return_date)->format('H:i') }}
                                @endif
                            </td>

                            <td class="text-center">
                                @if ($l->is_returned)
                                    <span class="badge bg-success" style="border-radius: 4px;">returned</span>
                                @else
                                    <span class="badge bg-warning text-dark" style="border-radius: 4px;">not returned</span>
                                @endif
                            </td>

                            <td>{{ $l->user->name ?? 'operator wikrama' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection