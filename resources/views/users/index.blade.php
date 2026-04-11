@extends('layouts.app')

@section('content')
<div class="container">

    <!-- ALERT PASSWORD -->
    @if(session('success'))
    <script>
        alert("Password: {{ session('success') }}");
    </script>
    @endif

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5>Admin Accounts Table</h5>
            <a href="/users/create" class="btn btn-primary mb-3">+ Add Items</a>
            
        </div>

        <div>
            <a href="#" class="btn btn-purple text-white me-2">Export Excel</a>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <!-- EDIT -->
                            <a href="{{ route('users.edit', $user->id) }}"
                               class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <!-- DELETE -->
                            <form action="{{ route('users.destroy', $user->id) }}"
                                  method="POST"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin hapus user ini?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No data</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>
@endsection