
@extends('layouts.app')

@section('content')

<div class="container-fluid px-4">
   <h1 class="mt-4">Categories</h1>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <p class="text-muted">Add, delete, update <span class="text-danger">.categories</span></p>
    </div>


<a href="/categories/create" class="btn btn-primary mb-3">+ Add Category</a>

   
    <table class="table table-bordered bg-white shadow-sm">
        <thead class="table-light">
            <tr class="text-center">
                <th>No</th>
                <th>Name</th>
                <th>Division PJ</th>
                <th>Total Items</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
<tr>
    <td class="text-center">{{ $loop->iteration }}</td>
    <td>{{ $item->name }}</td>
    
    {{-- Pastikan ini dipisah kolomnya --}}
    <td>{{ $item->division ?? 'N/A' }}</td> 
    
    <td class="text-center">{{ $item->items_count ?? 0 }}</td> 
    
    <td class="text-center">
        <a href="/categories/{{ $item->id }}/edit" class="btn btn-primary btn-sm" style="background-color: #6f42c1; border: none;">Edit</a>
    </td>
</tr>
@endforeach
        </tbody>
    </table>
</div>

@endsection