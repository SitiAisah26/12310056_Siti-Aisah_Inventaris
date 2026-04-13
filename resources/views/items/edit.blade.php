@extends('layouts.app')

@section('content')

<div class="container mt-4">
    
    <h4>Edit Item</h4>
    <p>Modify the details of the selected item.</p>

    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" 
                class="form-control @error('name') is-invalid @enderror" 
                value="{{ old('name', $item->name) }}">
            @error('name')
                <div class="text-danger mt-1">The name field is required.</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control select2 @error('category_id') is-invalid @enderror">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" 
                        {{ old('category_id', $item->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger mt-1">The category field is required.</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Total</label>
            <input type="number" name="total" 
                class="form-control @error('total') is-invalid @enderror" 
                value="{{ old('total', $item->total) }}">
            @error('total')
                <div class="text-danger mt-1">The total field is required.</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>New Broke Item (currently: <span class="badge bg-warning text-dark">{{ $item->repair }}</span>)</label>
            <input type="number" name="new_broke" value="0" 
                class="form-control @error('new_broke') is-invalid @enderror">
            <small class="text-muted italic">*Enter the number of newly damaged items to add to the repair count.</small>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection