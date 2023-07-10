@extends('admin.master')
@section('content')

    <h2>Add New Doctor</h2>
    @include('admin.errors')
    <form action="{{ route('admin.doctor.store') }}" method="POST" enctype="multipart/form-data">
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
            <textarea icols="20" rows="5" class="form-control" name="qualifications" placeholder="Qualifications"></textarea>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="address" placeholder="Address">
        </div>

        <div class="mb-3">
            <select class="form-control" name="rateing" id="">
                <option value="" selected disabled>Rateing</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="">Image</label><br>
            <input type="file" class="form-control" name="image">
        </div>

        <div class="mb-3">
            <!-- Default switch -->
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitches" name="status">
                <label class="custom-control-label" for="customSwitches">Open / Closed</label>
            </div>
        </div>
        <button class="btn btn-success btn-lg">SAVE</button>
    </form>
@stop
