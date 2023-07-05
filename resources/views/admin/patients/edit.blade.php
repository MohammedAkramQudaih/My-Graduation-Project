@extends('admin.master')
@section('content')

    <h2>Update Patient: <b class="text-info">{{ $patient->name }}</b></h2>
    @include('admin.errors')
    <form action="{{ route('admin.patient.update', $patient->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- @method('put') --}}
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name', $patient->name) }}">
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email', $patient->email) }}">
        </div> 
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="phone_No" placeholder="Phone Number" value="{{ old('phone_No', $patient->phone_No) }}">
        </div>  
        <div class="mb-3">
            <input type="text" class="form-control" name="age" placeholder="Age" value="{{ old('age', $patient->age) }}">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="address" placeholder="Address" value="{{ old('address', $patient->address) }}">
        </div>

        <div class="mb-3">
            <select class="form-control" name="gender" id="">
                <option value=""  disabled>Select Gender</option>
                <option value="male"@if ($patient->gender == 'male') selected @endif  >Male</option>
                <option value="female"@if ($patient->gender == 'female') selected @endif  >Female</option>
            </select>
        </div>
        <div class="mb-3">
            <select class="form-control" name="diabetic_type" id="">
                <option value=""  disabled>Select Diabetis Type</option>
                <option value="unknown"@if ($patient->diabetic_type == 'unknown') selected @endif  >Unknown</option>
                <option value="Type 1 Diabetes"@if ($patient->diabetic_type == 'Type 1 Diabetes') selected @endif  >Type 1 Diabetes</option>
                <option value="Type 2 Diabetes"@if ($patient->diabetic_type == 'Type 2 Diabetes') selected @endif  >Type 2 Diabetes</option>
                <option value="Gestational diabetes"@if ($patient->diabetic_type == 'Gestational diabetes') selected @endif  >Gestational diabetes</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="">Image</label><br>
            <img src="{{ asset('adminimages/patient/' . $patient->image) }}" width="100" height="100" alt="">
            <input type="file" class="form-control" name="image">
        </div>
        <div class="mb-3">
            <textarea icols="20" rows="5" class="form-control" name="patient_status" placeholder="Patient Status">{{ old('patient_status', $patient->patient_status) }}</textarea>
        </div>
        {{-- <div class="mb-3">
            <input type="text" class="form-control" name="phone_No" placeholder="Phone Number">
        </div> --}}
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

        {{-- <div class="mb-3">
            <input type="text" class="form-control" name="role" placeholder="Role"
                value="{{ old('role', $user->role) }}" disabled>
        </div> --}}

        <button class="btn btn-warning btn-lg">UPDATE</button>
    </form>
@stop
