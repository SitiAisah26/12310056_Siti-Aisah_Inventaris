@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            {{-- Judul Form --}}
            <h5 class="fw-bold mb-1" style="color: #2c3e50;">Lending Form</h5>
            <p class="text-muted small mb-4">Please <span class="text-danger">.fill-all</span> input form with right value.</p>

            {{-- Alert Error jika stok tidak cukup --}}
            @if(session('error'))
                <div class="alert alert-danger py-2 small border-0 shadow-sm mb-4">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('lendings.store') }}" method="POST">
                @csrf
                
                {{-- Name --}}
                <div class="mb-4">
                    <label class="form-label small fw-bold text-secondary">Name</label>
                    <input type="text" name="name" class="form-control form-control-lg fs-6" placeholder="Name" style="background-color: #f8f9fa; border: 1px solid #e9ecef;" required>
                </div>

                {{-- Items --}}
                <div class="mb-4">
                    <label class="form-label small fw-bold text-secondary">Items</label>
                    <select name="item_id" class="form-select form-control-lg fs-6" style="background-color: #f8f9fa; border: 1px solid #e9ecef;" required>
                        <option value="" disabled selected>Select Items</option>
                        @foreach($items as $item)
                            @php
                                $lentCount = $item->lendings->where('is_returned', false)->sum('total');
                                $available = $item->total - $item->repair - $lentCount;
                            @endphp
                            <option value="{{ $item->id }}" {{ $available <= 0 ? 'disabled' : '' }}>
                                {{ $item->name }} (Available: {{ $available }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Total --}}
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Total</label>
                    <input type="number" name="total" class="form-control form-control-lg fs-6" placeholder="total item" style="background-color: #f8f9fa; border: 1px solid #e9ecef;" required>
                </div>

                {{-- Fitur More --}}
                <div class="mb-4">
                    <a href="#" class="text-decoration-none small fw-bold" style="color: #17a2b8;">
                        <i class="fas fa-chevron-down me-1 small"></i> More
                    </a>
                </div>

                {{-- Ket. --}}
                <div class="mb-4">
                    <label class="form-label small fw-bold text-secondary">Ket.</label>
                    <textarea name="notes" class="form-control" rows="5" style="background-color: #f8f9fa; border: 1px solid #e9ecef;"></textarea>
                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn text-white px-4 py-2 fw-bold" style="background-color: #6f42c1; border-radius: 5px;">
                        Submit
                    </button>
                    <a href="{{ route('lendings.index') }}" class="btn btn-light px-4 py-2 fw-bold text-secondary" style="border: 1px solid #f8f9fa; background-color: #f8f9fa;">
                        Cancel
                    </a>
                </div>

                {{-- Hidden Date --}}
                <input type="hidden" name="date_time" value="{{ date('Y-m-d') }}">
            </form>
        </div>
    </div>
</div>
@endsection