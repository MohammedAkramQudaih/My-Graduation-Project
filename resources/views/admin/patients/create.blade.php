@extends('admin.master')
@section('content')

    <h2>Add New Patient</h2>
    @include('admin.errors')
    <form action="{{ route('admin.patient.store') }}" method="POST" enctype="multipart/form-data">
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
        <div class="mb-3">
            <input type="text" class="form-control" name="phone_No" placeholder="Phone Number">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="age" placeholder="Age">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="address" placeholder="Address">
        </div>

        <div class="mb-3">
            <select class="form-control" name="gender" id="">
                <option value="" selected disabled>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="mb-3">
            <select class="form-control" name="diabetic_type" id="">
                <option value="" selected disabled>Select Diabetis Type</option>
                <option value="unknown">Unknown</option>
                <option value="Type 1 Diabetes">Type 1 Diabetes </option>
                <option value="Type 2 Diabetes">Type 2 Diabetes</option>
                <option value="Gestational diabetes">Gestational diabetes</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="">Image</label><br>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="mb-3">
            <textarea icols="20" rows="5" class="form-control" name="patient_status" placeholder="Patient Status"></textarea>
        </div>



        {{-- <div class="mb-3">
            <!-- Default switch -->
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitches" name="flag">
                <label class="custom-control-label" for="customSwitches">Discount Price</label>
            </div>
        </div> --}}
        <button class="btn btn-success btn-lg">SAVE</button>
    </form>
@stop
