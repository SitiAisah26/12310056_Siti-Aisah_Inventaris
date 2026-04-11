@extends('layouts.app')

@section('content')

<div class="container mt-4">
    
    <h4>Add Category Forms</h4>
    <p>Please <span style="color:#d63384;">.fill-all</span> input form with right value.</p>

    <form action="/categories" method="POST">
        @csrf

        <!-- NAME -->
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" 
                class="form-control @error('name') is-invalid @enderror"
                placeholder="Name"
                value="{{ old('name') }}">

            @error('name')
                <div class="text-danger mt-1">
                    The name field is required
                </div>
            @enderror
        </div>

        <!-- DIVISION -->
        <div class="mb-3">
            <label>Division PJ</label>
            <select name="division" 
                class="form-control @error('division') is-invalid @enderror">
                
                <option value="">Select Division PJ</option>
                <option value="Sarpras">Sarpras</option>
                <option value="Tata Usaha">Tata Usaha</option>
                <option value="Tefa">Tefa</option>
            </select>

            @error('division')
                <div class="text-danger mt-1">
                    The division pj field is required
                </div>
            @enderror
        </div>

        <button class="btn btn-primary">Save</button>
    </form>
</div>

@endsection