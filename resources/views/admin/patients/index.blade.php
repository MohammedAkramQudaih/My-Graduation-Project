@extends('admin.master')
@section('content')

    <h2>All Patients {{ $patients->count() }} </h2>

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
            <th>Age</th>
            <th>Address</th>
            {{-- <th>Birthdate</th> --}}
            <th>Gender</th>
            <th>Diabetis Type</th>
            <th>Image</th>
            {{-- <th>Quantity</th> --}}
            {{-- <th>Serial_number</th> --}}
            {{-- <th>Status</th> --}}

            <th>Actions</th>
        </tr>
        @forelse ($patients as $patient)
            <tr>
                <td>{{ $patient->id }}</td>
                {{-- <td>{{ $loop->iteration }}</td> --}}
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->email }}</td>
                <td>{{ $patient->phone_No }}</td>
                <td>{{ $patient->age }}</td>
                <td>{{ $patient->address }}</td>
                {{-- <td>{{ $patient->birthdate }}</td> --}}
                <td>{{ $patient->gender }}</td>
                <td>{{ $patient->diabetic_type }}</td>
                <td><img src="{{ asset('adminimages/patient/' . $patient->image) }}" width="100" height="100"
                        alt=""></td>

                {{-- <td>{{ $patient->patient_status }}</td> --}}


                <td>
                    @if ($patient->deleted_at == null)
                        <div class="btn-group-vertical" role="group">
                            <a href="{{ route('admin.patient.edit', $patient->id) }}"
                                class="btn btn-primary btn-sm">Edit</a>
                            <a href="{{ route('admin.patient.patientBiography', $patient->id) }}"
                                class="btn btn-info btn-sm">PatientBiography</a>
                            <a href="{{ route('admin.patient.measurements', $patient->id) }}"
                                class="btn btn-success btn-sm">Measurements</a>
                            <a href="{{ route('admin.patient.appointments', $patient->id) }}"
                                class="btn btn-info btn-sm">Appointments</a>
                            <a href="{{ route('admin.patient.attachments', $patient->id) }}"
                                class="btn btn-success btn-sm">Attachments</a>
                            {{-- <a href="{{ route('admin.patient.doctors', $patient->id) }}"
                                class="btn btn-info btn-sm">Doctors</a> --}}
                            <a href="{{ route('admin.patient.reviews', $patient->id) }}"
                                class="btn btn-info btn-sm">Rviews</a>
                            <form class="d-inline" action="{{ route('admin.patient.destroy', $patient->id) }}"
                                method="POST">
                                @csrf
                                {{-- @method('delete') --}}
                                <button onclick="return confirm('Are you sour?!')"
                                    class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    @else
                        <form class="d-inline" action="{{ route('admin.patient.restore', $patient->id) }}" method="POST">
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
    {{ $patients->links() }}
@stop
