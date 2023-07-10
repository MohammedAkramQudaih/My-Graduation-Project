@extends('admin.master')
@section('content')

    <h2>All Doctors {{ $doctors->count() }} </h2>

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
            <th>email</th>
            <th>Phone Number</th>
            <th>Qualifications</th>
            <th>Address</th>
            {{-- <th>Birthdate</th> --}}
            <th>Rateing</th>
            <th>Status</th>
            <th>Image</th>
            {{-- <th>Quantity</th> --}}
            {{-- <th>Serial_number</th> --}}
            {{-- <th>Status</th> --}}

            <th>Actions</th>
        </tr>
        @forelse ($doctors as $doctor)
            <tr>
                <td>{{ $doctor->id }}</td>
                {{-- <td>{{ $loop->iteration }}</td> --}}
                <td>{{ $doctor->name }}</td>
                <td>{{ $doctor->email }}</td>
                <td>{{ $doctor->phone_No }}</td>
                <td>{{ $doctor->qualifications }}</td>
                <td>{{ $doctor->address }}</td>
                {{-- <td>{{ $patient->birthdate }}</td> --}}
                <td>{{ $doctor->rateing }}</td>
                <td>{{ $doctor->status }}</td>
                <td><img src="{{ asset('adminimages/doctor/' . $doctor->image) }}" width="100" height="100" alt=""></td>

                {{-- <td>{{ $patient->patient_status }}</td> --}}


                <td>
                    @if ($doctor->deleted_at == null)
                    <a href="{{ route('admin.doctor.edit', $doctor->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form class="d-inline" action="{{ route('admin.doctor.destroy', $doctor->id) }}" method="POST">
                        @csrf
                        {{-- @method('delete') --}}
                        <button onclick="return confirm('Are you sour?!')" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                @else
                    <form class="d-inline" action="{{ route('admin.doctor.restore', $doctor->id) }}" method="POST">
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
    {{ $doctors->links() }}
@stop
