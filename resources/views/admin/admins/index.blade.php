@extends('admin.master')
@section('content')

    <h2>All Admins {{ $admins->count() }} </h2>

    @if (session('msg'))
        <div class="alert alert-{{ session('type') }} alert-dismissible fade show">
            {{ session('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif




    <table class="table table-bordered">
        <tr class="bg-dark text-white">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created</th>
            <th>Actions</th>

        </tr>
        @forelse ($admins as $admin)
            <tr>
                {{-- <td>{{ $admin->id }}</td> --}}
                <td>{{ $loop->iteration }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->created_at->diffForHumans() }}</td>



                <td>
                    @if ($admin->deleted_at == null)
                        <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form class="d-inline" action="{{ route('admin.destroy', $admin->id) }}" method="POST">
                            @csrf
                            {{-- @method('delete') --}}
                            <button onclick="return confirm('Are you sour?!')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @else
                        <form class="d-inline" action="{{ route('admin.restore', $admin->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-warning btn-sm">Restore</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8"class="text-center">No Data Found</td>
            </tr>
        @endforelse

    </table>
    {{ $admins->links() }}
@stop
