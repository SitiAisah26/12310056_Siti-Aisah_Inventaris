@extends('layouts.app')

@section('content')

<h4>Items</h4>

<a href="/items/create" class="btn btn-primary mb-3">+ Add Items</a>

<table class="table table-bordered bg-white shadow-sm">
    <tr>
        <th>No</th>
        <th>Category</th>
        <th>Nama Item</th>
        <th>Total</th>
        <th>Repair</th>
        <th>Lending</th>
        <th>Aksi</th>
    </tr>

    @foreach($items as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->category->name }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->total }}</td>
        <td>{{ $item->repair }}</td>

        <td>
           @if($item->lendings_count > 0)
                <a href="{{ route('items.lendings', $item->id) }}">
                    {{ $item->lendings_count }}
                </a>
            @else
                0
            @endif  
        </td>

        <td>
            <a href="/items/{{ $item->id }}/edit" class="btn btn-primary btn-sm" style="background-color: #6f42c1; border: none;">Edit</a>

            <form action="/items/{{ $item->id }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                Delete
            </button>
            </form> 
        </td>
    </tr>
    @endforeach

</table>

@endsection