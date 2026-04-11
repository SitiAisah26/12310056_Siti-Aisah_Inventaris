@extends('layouts.app')

@section('content')

<h4>Edit Item</h4>

<form action="{{ route('items.update', $item->id) }}" method="POST">
@csrf
@method('PUT')

<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" value="{{ $item->name }}" class="form-control">
</div>

<div class="mb-3">
    <label>Category</label>
    <select name="category_id" class="form-control select2">
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" 
                {{ $item->category_id == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Total</label>
    <input type="number" name="total" value="{{ $item->total }}" class="form-control">
</div>

<div class="mb-3">
    <label>New Broke Item (currently: {{ $item->repair }})</label>
    <input type="number" name="new_broke" value="0" class="form-control">
</div>

<button class="btn btn-primary">Update</button>
</form>

@endsection