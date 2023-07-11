@extends('admin.master')
@section('content')

    <h2>Update Admin: <b class="text-info">{{ $admin->name }}</b></h2>
    @include('admin.errors')
    <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- @method('put') --}}
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name', $admin->name) }}">
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email"
                value="{{ old('email', $admin->email) }}">
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>



        {{-- <div class="mb-3">
            <label for="">Image</label><br>
            <img src="{{ asset('adminimages/doctor/' . $doctor->image) }}" width="100" height="100" alt="">
            <input type="file" class="form-control" name="image">
        </div> --}}




        <button class="btn btn-warning btn-lg">UPDATE</button>
    </form>
@stop
