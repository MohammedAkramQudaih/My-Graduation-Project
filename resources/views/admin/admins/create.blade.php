@extends('admin.master')
@section('content')

    <h2>Add New Admin</h2>
    @include('admin.errors')
    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Name">
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        

        {{-- <div class="mb-3">
            <label for="">Image</label><br>
            <input type="file" class="form-control" name="image">
        </div> --}}

        
        <button class="btn btn-success btn-lg">SAVE</button>
    </form>
@stop
