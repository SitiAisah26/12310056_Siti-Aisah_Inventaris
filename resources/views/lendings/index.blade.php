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
                    <div class="d-flex align-items-center gap-1">
                        <a href="{{ route('users.export', ['role' => 'admin']) }}"
                            class="btn shadow-sm px-3 d-flex align-items-center justify-content-center"
                            style="background-color: #6f42c1; color: white; border: none; height: 38px; border-radius: 6px 0 0 6px;">
                            <i class="fas fa-file-excel me-2"></i> Export Excel
                        </a>
                        <a href="{{ route('lendings.create') }}"
                            class="btn shadow-sm px-3 d-flex align-items-center justify-content-center"
                            style="background-color: #a289d3; color: white; border: none; height: 38px; border-radius: 0 6px 6px 0;">
                            <i class="fas fa-plus me-2"></i> Add Lending
                        </a>
                    @else
                        <a href="{{ route('items.index') }}" class="btn btn-secondary shadow-sm px-4">
                            Back to Items
                        </a>
                @endif
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm">
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
                <th>Date</th>
                <th>Returned Status</th>
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
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($lending->date_time)->format('Y-m-d H:i:s') }}
                    </td>
                    <td class="text-center">
                        @if ($lending->is_returned)
                            <span class="text-success fw-bold">
                                {{ $lending->return_date ? \Carbon\Carbon::parse($lending->return_date)->format('Y-m-d H:i:s') : 'Returned' }}
                            </span>
                            <br>
                            <small class="text-muted">item is returned!</small>
                        @else
                            <span class="badge bg-light text-warning border border-warning">not returned</span>
                        @endif
                    </td>
                    <td class="text-center"><strong>{{ $lending->user->name ?? 'operator wikrama' }}</strong></td>

                    @if (Auth::user()->role == 'operator')
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                @if (!$lending->is_returned && Auth::user()->role == 'operator')
                                    <form action="{{ route('lendings.restore', $lending->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-warning btn-sm text-white"
                                            style="background-color: #ffc107; border: none;">
                                            Returned
                                        </button>
                                    </form>
                                @endif

                                @if (Auth::user()->role == 'operator')
                                    <form action="{{ route('lendings.destroy', $lending->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ Auth::user()->role == 'operator' ? '9' : '8' }}" class="text-center text-muted py-3">No
                        lending data found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
@endsection
