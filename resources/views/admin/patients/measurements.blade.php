@extends('admin.master')
@section('content')

    {{-- <h2>All Users {{ $users->count() }} </h2> --}}
    <h2>Measurements of the patient : <b class="text-info">{{ $patient->name }}</b></h2>


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
            <th>Measurement Date</th>
            <th>Fasting</th>
            <th>Creator</th>
            <th>Random</th>
        </tr>

        @forelse ($measurements as $measurement)
            <tr>
                <td>{{ $measurement->id }}</td>
                <td>{{ $measurement->created_at }}</td>
                <td>{{ $measurement->Fasting }}</td>
                <td>{{ $measurement->creator }}</td>
                <td>{{ $measurement->random }}</td>


            </tr>
        @empty
            <tr>
                <td colspan="8"class="text-center">No Data Found</td>
            </tr>
        @endforelse

    </table>
    {{ $measurements->links() }}

@stop
