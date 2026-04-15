@extends('layouts.app')

@section('content')

<div class="container mt-4">
    
    <h4>Edit Category</h4>

    <form action="/categories/{{ $data->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" 
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $data->name) }}">

            @error('name')
                <div class="text-danger">The name field is required</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Division PJ</label>
            <select name="division" 
                class="form-control @error('division') is-invalid @enderror">

                <option value="">Select Division</option>
                <option value="Sarpras" {{ $data->division == 'Sarpras' ? 'selected' : '' }}>Sarpras</option>
                <option value="Tata Usaha" {{ $data->division == 'Tata Usaha' ? 'selected' : '' }}>Tata Usaha</option>
                <option value="Tefa" {{ $data->division == 'Tefa' ? 'selected' : '' }}>Tefa</option>
            </select>

            @error('division')
                <div class="text-danger">The division pj field is required</div>
            @enderror
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="/categories" class="btn btn-secondary">Cancel</a>
    </form>

</div>

@endsection