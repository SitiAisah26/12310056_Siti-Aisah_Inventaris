@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <h5 class="fw-bold mb-1" style="color: #2c3e50;">Lending Form</h5>
            <p class="text-muted small mb-4">
                Please <span class="text-danger">.fill-all</span> input form with right value.
            </p>

            @if(session('error'))
                <div class="alert alert-danger py-2 small border-0 shadow-sm mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('lendings.store') }}" method="POST">
                @csrf

                {{-- NAME --}}
                <div class="mb-4">
                    <label class="form-label small fw-bold text-secondary">Name</label>
                    <input type="text" name="name"
                        class="form-control form-control-lg fs-6"
                        style="background-color:#f8f9fa;border:1px solid #e9ecef;"
                        required>
                </div>

                {{-- ITEMS --}}
                <div id="items-wrapper">

                    {{-- ROW PERTAMA --}}
                    <div class="item-row mb-4 border rounded p-3 position-relative"
                        style="background-color:#f8f9fa;border:1px solid #e9ecef;">

                        {{-- HIDDEN X --}}
                        <button type="button"
                            class="btn btn-sm btn-primary position-absolute top-0 end-0 m-2 remove-item d-none">
                            X
                        </button>

                        <label class="form-label small fw-bold text-secondary">Items</label>
                        <select name="items[0][item_id]"
                            class="form-select form-control-lg fs-6 item-select"
                            style="background-color:#f8f9fa;border:1px solid #e9ecef;"
                            required>

                            <option value="" disabled selected>Select Items</option>

                            @foreach($items as $item)
                                @php
                                    $lentCount = $item->lendings->where('is_returned', false)->sum('total');
                                    $available = $item->total - $item->repair - $lentCount;
                                @endphp
                                <option value="{{ $item->id }}" data-stock="{{ $available }}">
                                    {{ $item->name }} (Available: {{ $available }})
                                </option>
                            @endforeach
                        </select>

                        <label class="form-label small fw-bold text-secondary mt-3">Total</label>
                        <input type="number"
                            name="items[0][total]"
                            class="form-control form-control-lg fs-6 item-total"
                            placeholder="total item"
                            style="background-color:#f8f9fa;border:1px solid #e9ecef;"
                            min="1"
                            required>

                        <small class="text-danger d-none stock-error">
                            total item more than available
                        </small>
                    </div>
                </div>

                {{-- MORE --}}
                <div class="mb-4">
                    <a href="javascript:void(0)" id="add-item"
                        class="text-decoration-none small fw-bold"
                        style="color:#17a2b8;">
                        <i class="fas fa-chevron-down me-1 small"></i> More
                    </a>
                </div>

                {{-- NOTES --}}
                <div class="mb-4">
                    <label class="form-label small fw-bold text-secondary">Ket.</label>
                    <textarea name="notes"
                        class="form-control"
                        rows="5"
                        style="background-color:#f8f9fa;border:1px solid #e9ecef;"></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit"
                        class="btn text-white px-4 py-2 fw-bold"
                        style="background-color:#6f42c1;">
                        Submit
                    </button>

                    <a href="{{ route('lendings.index') }}"
                        class="btn btn-light px-4 py-2 fw-bold text-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function(){

    let index = 1;

    document.getElementById('add-item').addEventListener('click', function () {
        let wrapper = document.getElementById('items-wrapper');

        let newItem = document.querySelector('.item-row').cloneNode(true);

        newItem.querySelector('.item-select').name = `items[${index}][item_id]`;
        newItem.querySelector('.item-total').name = `items[${index}][total]`;

        newItem.querySelector('.item-select').value = '';
        newItem.querySelector('.item-total').value = '';
        newItem.querySelector('.stock-error').classList.add('d-none');

        newItem.querySelector('.remove-item').classList.remove('d-none');

        wrapper.appendChild(newItem);
        index++;
    });

    // REMOVE
    document.addEventListener('click', function(e){
        if(e.target.classList.contains('remove-item')){
            let rows = document.querySelectorAll('.item-row');
            if(rows.length > 1){
                e.target.closest('.item-row').remove();
            }
        }
    });

    // VALIDASI
    document.addEventListener('input', function(e){
        if(e.target.classList.contains('item-total')){
            let row = e.target.closest('.item-row');
            let select = row.querySelector('.item-select');
            let stock = select.options[select.selectedIndex]?.dataset.stock;
            let total = e.target.value;

            let error = row.querySelector('.stock-error');

            if(stock && total > stock){
                error.classList.remove('d-none');
            } else {
                error.classList.add('d-none');
            }
        }
    });

});
</script>

@endsection