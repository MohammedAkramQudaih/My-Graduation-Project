@extends('admin.master')
@section('content')

    <h2>Update Doctor: <b class="text-info">{{ $doctor->name }}</b></h2>
    @include('admin.errors')
    <form action="{{ route('admin.doctor.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- @method('put') --}}
        <div class="mb-3">
            <input type="text" class="form-control" name="name" placeholder="Name"
                value="{{ old('name', $doctor->name) }}">
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email"
                value="{{ old('email', $doctor->email) }}">
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="phone_No" placeholder="Phone Number"
                value="{{ old('phone_No', $doctor->phone_No) }}">
        </div>
        <div class="mb-3">
            <textarea icols="20" rows="5" class="form-control" name="qualifications" placeholder="Qualifications">{{ old('qualifications', $doctor->qualifications) }}</textarea>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="address" placeholder="Address"
                value="{{ old('address', $doctor->address) }}">
        </div>

        <div class="mb-3">
            <select class="form-control" name="rateing" id="">
                <option value="" disabled>Rateing</option>
                <option value="1"@if ($doctor->rateing == '1') selected @endif>1</option>
                <option value="2"@if ($doctor->rateing == '2') selected @endif>2</option>
                <option value="3"@if ($doctor->rateing == '3') selected @endif>3</option>
                <option value="4"@if ($doctor->rateing == '4') selected @endif>4</option>
                <option value="5"@if ($doctor->rateing == '5') selected @endif>5</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="">Image</label><br>
            <img src="{{ asset('adminimages/doctor/' . $doctor->image) }}" width="100" height="100" alt="">
            <input type="file" class="form-control" name="image">
        </div>

        <div class="mb-3">
            <!-- Default switch -->
            <div class="custom-control custom-switch">
                <input type="checkbox" @if ($doctor->status == 'open') checked @endif class="custom-control-input"
                    id="customSwitches" name="status">
                <label class="custom-control-label" for="customSwitches">Open / Closed</label>
            </div>
        </div>


        <button class="btn btn-warning btn-lg">UPDATE</button>
    </form>
@stop
