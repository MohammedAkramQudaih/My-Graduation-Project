@extends('admin.master')
@section('content')

    {{-- <h2>All Users {{ $users->count() }} </h2> --}}
    <h2>Appointments of the Dr.  : <b class="text-info">{{ $doctor->name }}</b></h2>


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
            {{-- <th>Patient Name</th> --}}
            <th>Patient Name</th>
            <th>Booking Day</th>
            <th>Booking Date</th>
            <th>Booking Time</th>
            <th>status</th>
            <th>Created</th>
        </tr>

        @forelse ($appointments as $appointment)
            <tr>
                <td>{{ $appointment->id }}</td>

                <td>
                    @foreach ($patients as $patient)
                        @if ($appointment->patient_id == $patient->id)
                            {{ $patient->name }}
                        @endif
                    @endforeach
                </td>
                <td>{{ $appointment->booking_day }}</td>
                <td>{{ $appointment->booking_date }}</td>
                <td>{{ $appointment->booking_time }}</td>
                <td>{{ $appointment->status }}</td>
                <td>{{ $appointment->created_at->diffForHumans() }}</td>


            </tr>
        @empty
            <tr>
                <td colspan="8"class="text-center">No Data Found</td>
            </tr>
        @endforelse

    </table>
    {{ $appointments->links() }}

@stop
