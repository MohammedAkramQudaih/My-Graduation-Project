@extends('admin.master')
@section('content')

    {{-- <h2>All Users {{ $users->count() }} </h2> --}}
    <h2>Reviews of the patient : <b class="text-info">{{ $patient->name }}</b></h2>


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
            <th>Doctor Name</th>
            <th>review_day</th>
            <th>review_date</th>
            <th>review_time</th>
            <th>Created</th>
        </tr>

        @forelse ($reviews as $review)
            <tr>
                <td>{{ $review->id }}</td>

                <td>
                    @foreach ($doctors as $doctor)
                        @if ($review->doctor_id == $doctor->id)
                            {{ $doctor->name }}
                        @endif
                    @endforeach
                </td>
                <td>{{ $review->review_day }}</td>
                <td>{{ $review->review_date }}</td>
                <td>{{ $review->review_time }}</td>
                <td>{{ $review->created_at->diffForHumans() }}</td>


            </tr>
        @empty
            <tr>
                <td colspan="8"class="text-center">No Data Found</td>
            </tr>
        @endforelse

    </table>
    {{ $reviews->links() }}

@stop
