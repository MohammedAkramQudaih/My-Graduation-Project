@extends('admin.master')
@section('content')

    {{-- <h2>All Users {{ $users->count() }} </h2> --}}
    <h2>attachments of the patient : <b class="text-info">{{ $patient->name }}</b></h2>


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
            <th>File Name</th>
            <th>File Path</th>
            <th>Created</th>

        </tr>

        @forelse ($attachments as $attachment)
            <tr>
                <td>{{ $attachment->id }}</td>
                <td>{{ $attachment->filename }}</td>
                <td><a href="localhost:8000/api/patient/attachments/{{ $attachment->filepath }}" class="btn btn-purple btn-sm">Attachment</a></td>
                <td>{{ $attachment->created_at->diffForHumans() }}</td>



            </tr>
        @empty
            <tr>
                <td colspan="8"class="text-center">No Data Found</td>
            </tr>
        @endforelse

    </table>
    {{ $attachments->links() }}

@stop
