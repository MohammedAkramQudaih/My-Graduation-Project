@extends('admin.master')
@section('content')

    <h2>All Users {{ $users->count() }} </h2>

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
            <th>Role</th>
            {{-- <th>Actions</th> --}}
        </tr>
        @forelse ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                {{-- <td>{{ $loop->iteration }}</td> --}}
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                
              

                {{-- <td>
                    @if ($user->deleted_at == null)
                    <a href="{{ route('admin.user.edit',$user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form class="d-inline" action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                        @csrf --}}
                        {{-- @method('delete') --}}
                        {{-- <button onclick="return confirm('Are you sour?!')" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                @else
                    <form class="d-inline" action="{{ route('admin.user.restore', $user->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-warning btn-sm">Restore</button>
                    </form>
                @endif
                </td> --}}
            </tr>
        @empty
            <tr>
                <td colspan="8"class="text-center">No Data Found</td>
            </tr>
        @endforelse

    </table>
    {{ $users->links() }}
@stop
