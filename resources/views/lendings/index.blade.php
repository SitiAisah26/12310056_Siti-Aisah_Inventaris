@extends('layouts.app')

@section('content')
<div class="mb-5 text-white rounded-bottom position-relative shadow-sm"
    style="background: url('https://picsum.photos/1200/300'); background-size: cover; background-position: center; height:220px;">

    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.4);"></div>

    <div class="h-100 d-flex justify-content-between align-items-center position-relative px-4">
        <div class="d-flex align-items-center gap-3">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="110"
                style="filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.3));">

            <div class="lh-sm">
                <h3 class="fw-bold mb-0">Welcome Back,</h3>
                <h5 class="mb-0 opacity-75">
                    {{ Auth::user()->role == 'admin' ? 'Admin Wikrama' : 'Operator Wikrama' }}
                </h5>
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

<div class="container-fluid px-4 mt-5">
    <h1 class="mt-4">Lending Table</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="text-muted">Data of <span class="text-danger">.lendings</span></p>

        <div>
            @if (Auth::user()->role == 'operator')
                <div class="d-flex gap-2">
                    <a href="{{ route('lendings.export') }}"
                        class="btn text-white" style="background:#6f42c1;">
                        <i class="fas fa-file-excel me-2"></i> Export Excel
                    </a>

                    <a href="{{ route('lendings.create') }}"
                        class="btn text-white" style="background:#a289d3;">
                        + Add Lending
                    </a>
                </div>
            @else
                <a href="{{ route('items.index') }}" class="btn btn-secondary">
                    Back to Items
                </a>
            @endif
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered bg-white shadow-sm">
        <thead class="table-light">
            <tr class="text-center">
                <th>No</th>
                <th>Item</th>
                <th>Total</th>
                <th>Name</th>
                <th>Ket.</th>
                <th>Date & Time</th>
                <th>Status</th>
                <th>Edited By</th>
                @if (Auth::user()->role == 'operator')
                    <th>Action</th>
                @endif
            </tr>
        </thead>

        <tbody>
        @forelse($lendings as $index => $lending)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>

                <td>{{ $lending->item->name }}</td>

                <td class="text-center">{{ $lending->total }}</td>

                <td>{{ $lending->name }}</td>

                <td>{{ $lending->notes ?? '-' }}</td>

                {{-- DATE + TIME --}}
                <td class="text-center">
                    @if ($lending->is_returned)
                        <div>
                            <small class="text-muted">Borrow</small><br>
                            {{ \Carbon\Carbon::parse($lending->date_time)->format('d M Y H:i') }}
                        </div>

                        <div class="mt-1">
                            <small class="text-muted">Return</small><br>
                            {{ \Carbon\Carbon::parse($lending->return_date)->format('d M Y H:i') }}
                        </div>
                    @else
                        {{ \Carbon\Carbon::parse($lending->date_time)->format('d M Y H:i') }}
                    @endif
                </td>

                {{-- STATUS --}}
                <td class="text-center">
                    @if ($lending->is_returned)
                        <span class="badge bg-success">Returned</span>
                    @else
                        <span class="badge bg-warning text-dark">Not Returned</span>
                    @endif
                </td>

                {{-- USER --}}
                <td class="text-center">
                    <strong>{{ $lending->user->name ?? 'operator wikrama' }}</strong>
                </td>

                {{-- ACTION --}}
                @if (Auth::user()->role == 'operator')
                <td class="text-center">
                    <div class="d-flex justify-content-center gap-2">

                        {{-- tombol hanya muncul kalau belum return --}}
                        @if (!$lending->is_returned)
                            <form action="{{ route('lendings.restore', $lending->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="btn btn-warning btn-sm text-white">
                                    Returned
                                </button>   
                            </form>
                        @endif

                        <form action="{{ route('lendings.destroy', $lending->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>

                    </div>
                </td>
                @endif

            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center text-muted py-3">
                    No lending data found.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection