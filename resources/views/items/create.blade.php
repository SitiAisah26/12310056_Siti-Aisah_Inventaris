@extends('layouts.app')

@section('content')

<div class="container mt-4">
    
    <h4>Add Items Forms</h4>
    <p>Please <span style="color:#d63384;">.fill-all</span> input form with right value.</p>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <form action="{{ route('items.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" 
                class="form-control @error('name') is-invalid @enderror" 
                placeholder="Name"
                value="{{ old('name') }}">
            
            @error('name')
                <div class="text-danger mt-1">The name field is required.</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" 
                class="form-control select2 @error('category_id') is-invalid @enderror">
                
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
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
                placeholder="Total"
                value="{{ old('total') }}">
            
            @error('total')
                <div class="text-danger mt-1">The total field is required.</div>
            @enderror
        </div>

        <button class="btn btn-primary">Save</button>
    </form>
</div>

@endsection