@extends('admin.master')
@section('content')

    <h2>Update User: <b class="text-info">{{ $user->name }}</b></h2>
    @include('admin.errors')
    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- @method('put') --}}
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name', $user->name) }}">
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="oldpassword" placeholder="Old Password">
        </div> 
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>  
        {{-- <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email"
                value="{{ old('email', $user->email) }}">
        </div> --}}

        {{-- <div class="mb-3">
            <select class="form-control" name="role" id="">
                <option value=""  disabled>Select Role</option>
                <option value="patient"@if ($user->role == 'patient') selected @endif disabled >Patient</option>
                <option value="doctor"@if ($user->role == 'doctor') selected @endif  disabled>Doctor</option>
                <option value="admin"@if ($user->role == 'admin') selected @endif  disabled>Admin</option>
            </select>
        </div> --}}

        <div class="mb-3">
            <input type="text" class="form-control" name="role" placeholder="Role"
                value="{{ old('role', $user->role) }}" disabled>
        </div>

        <button class="btn btn-warning btn-lg">UPDATE</button>
    </form>
@stop
