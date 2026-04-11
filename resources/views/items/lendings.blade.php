@extends('layouts.app')

@section('content')

<div class="container-fluid px-4">

    <!-- HEADER -->
    <div class="mb-4 p-4 text-white rounded" style="background: url('https://picsum.photos/1200/200'); background-size: cover;">
        <h4>Welcome Back, Admin</h4>
        <div class="d-flex justify-content-between">
            <span>Item: {{ $item->name }}</span>
            <span>{{ now()->format('d F Y') }}</span>
        </div>
    </div>

    <!-- CARD -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
            <span>Lending Table</span>
            <a href="{{ route('items.index') }}" class="btn btn-secondary btn-sm">Back</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Name</th>
                        <th>Ket.</th>
                        <th>Date</th>
                        <th>Returned</th>
                        <th>Edited By</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($lendings as $l)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $l->name }}</td>
                        <td>{{ $l->description }}</td>
                        <td>{{ \Carbon\Carbon::parse($l->date)->format('d F Y') }}</td>
                        <td>
                            @if($l->returned)
                                <span class="badge bg-success">returned</span>
                            @else
                                <span class="badge bg-warning text-dark">not returned</span>
                            @endif
                        </td>
                        <td>{{ $l->created_by ?? 'admin' }}</td>
                    </tr>
                    @endforeach
                </tbody>    

            </table>
        </div>
    </div>

</div>

@endsection