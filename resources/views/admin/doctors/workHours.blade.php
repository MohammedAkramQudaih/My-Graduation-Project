@extends('admin.master')
@section('content')

    {{-- <h2>All Users {{ $users->count() }} </h2> --}}
    <h2>workHours of the Dr.  <b class="text-info">{{ $doctor->name }}</b></h2>


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
            <th>Day</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Created</th>
        </tr>

        @forelse ($workHours as $workHour)
            <tr>
                <td>{{ $workHour->id }}</td>
                <td>{{ $workHour->day }}</td>
                <td>{{ $workHour->start_time }}</td>
                <td>{{ $workHour->end_time }}</td>
                <td>{{ $workHour->created_at->diffForHumans() }}</td>


            </tr>
        @empty
            <tr>
                <td colspan="8"class="text-center">No Data Found</td>
            </tr>
        @endforelse

    </table>
    {{ $workHours->links() }}

@stop
