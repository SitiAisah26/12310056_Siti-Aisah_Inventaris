@extends('layouts.app')

@section('content')
    {{-- Header Section --}}
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
                {{-- Format: Bulan Tanggal, Tahun (Contoh: April 13, 2026) --}}
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

    {{-- Main Content Section --}}
    <div class="container-fluid px-4">
        <h1 class="mt-4">Items</h1>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="text-muted">Manage your inventory <span class="text-danger">.items</span></p>
            @if (Auth::user()->role != 'operator')
                <div class="d-flex align-items-center gap-1">
                    {{-- Tombol Export Excel --}}
                    <a href="{{ route('items.export') }}"
                        class="btn shadow-sm px-3 d-flex align-items-center justify-content-center"
                        style="background-color: #6f42c1; color: white; border: none; height: 38px; border-radius: 6px 0 0 6px;">
                        <i class="fas fa-file-excel me-2"></i> Export Excel
                    </a>
                    {{-- Tombol Add Items --}}
                    <a href="/items/create" class="btn shadow-sm px-3 d-flex align-items-center justify-content-center"
                        style="background-color: #a289d3; color: white; border: none; height: 38px; border-radius: 0 6px 6px 0;">
                        <i class="fas fa-plus me-2"></i> Add Items
                    </a>
                </div>
            @endif
        </div>

        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-light">
                <tr class="text-center">
                    <th>No</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Total</th>
                    @if (Auth::user()->role == 'admin')
                        <th>Repair</th>
                        <th>Lending</th>
                        <th>Action</th>
                    @else
                        <th>Available</th>
                        <th>Lending Total</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    @php
                        // Available = Total - (Peminjaman Aktif + Rusak)
                        // Nilai ini akan otomatis bertambah jika lending dikembalikan atau dihapus
                        $available = $item->total - ($item->lendings_count + $item->repair);
                    @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td class="text-center">{{ $item->total }}</td>

                        @if (Auth::user()->role == 'admin')
                            {{-- Tampilan Admin --}}
                            <td class="text-center">
                                {{ $item->repair == 0 ? '-' : $item->repair }}
                            </td>
                            <td class="text-center">
                                {{-- Menggunakan kode yang kamu minta agar lebih simpel --}}
                                {{ $item->lendings_count }}
                            </td>
                            <td class="text-center">
                                <a href="/items/{{ $item->id }}/edit" class="btn btn-primary btn-sm"
                                    style="background-color: #6f42c1; border: none;">Edit</a>
                                <form action="/items/{{ $item->id }}" method="POST" style="display:inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        @else
                            {{-- Tampilan Operator: Sesuai logika di gambar image_bb59ef.png --}}
                            <td class="text-center">{{ $available }}</td>
                            <td class="text-center">{{ $item->lendings_count }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
