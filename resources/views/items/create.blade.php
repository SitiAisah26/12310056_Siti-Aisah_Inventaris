@extends('layouts.app')

@section('content')

<h4>Add Items Forms</h4>
<p>Please <span style="color:#d63384;">.fill-all</span> input form with right value.</p>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

<form action="{{ route('items.store') }}" method="POST">
@csrf

<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
    @error('name')
        <div class="text-danger">The name field is required.</div>
    @enderror
</div>

<div class="mb-3">
    <label>Category</label>
    <select name="category_id" class="form-control select2 @error('category_id') is-invalid @enderror">
        <option value="">Pilih Category</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>
    @error('category_id')
        <div class="text-danger">The category field is required.</div>
    @enderror
</div>

<div class="mb-3">
    <label>Total</label>
    <input type="number" name="total" class="form-control @error('total') is-invalid @enderror">
    @error('total')
        <div class="text-danger">The total field is required.</div>
    @enderror
</div>

<button class="btn btn-primary">Save</button>
</form>

@endsection