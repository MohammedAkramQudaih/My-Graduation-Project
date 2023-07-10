<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $doctors = Doctor::withTrashed()->paginate(15);
        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.doctors.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'email' => 'required|email|unique:patients|unique:users',
            'name' => 'required|string',
            'password' => ['required'],
            // 'gender' => ['required'],
            // 'phone_No' => ['numeric'],
            // 'age' => ['nullable'],
            'image' => ['file'],

        ]);

        $imageName = '';
        $file = $request->file('image');
        if (!is_null($file)) {
            $ex = $file->getClientOriginalExtension();
            $imageName = 'doctorImage' . rand() . time() . '.' . $ex;
            $file->move(public_path('adminimages/doctor/'), $imageName);
            // $patient->update(['image' => $imageName,]);
        }

        if ($request->status == 'on') {
            $status = 'open';
        } else $status = 'closed';

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'role' => 'doctor'
        ]);
        Doctor::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone_No' => $request->phone_No,
            'qualifications' => $request->qualifications,
            'image' => $imageName,
            'address' => $request->address,
            'rateing' => $request->rateing,
            'status' => $status,
            // 'patient_status' => $request->patient_status
        ]);

        return redirect()->route('admin.doctors.list')->with('msg', 'Doctor Created Successfully')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $doctor = Doctor::findOrFail($id);
        $user = User::where('id', $doctor->user_id)->first();

        $request->validate([
            // 'email' => 'required|email|unique:patients|unique:users',
            'email' => 'required|email',
            'name' => 'required|string',
            // 'password' => ['required'],
            // 'gender' => ['required'],
            // 'phone_No' => ['numeric'],
            // 'age' => ['nullable'],
            'image' => ['file'],

        ]);

        $imageName = $doctor->image;;
        $file = $request->file('image');
        if (!is_null($file)) {
            $ex = $file->getClientOriginalExtension();
            $imageName = 'doctorImage' . rand() . time() . '.' . $ex;
            $file->move(public_path('adminimages/doctor/'), $imageName);
            $doctor->update(['image' => $imageName,]);
        }

        if ($request->status == 'on') {
            $status = 'open';
        } else $status = 'closed';

        if (!is_null($request->email)) {
            $user->update(['email' => $request->email,]);
        }
        if (!is_null($request->name)) {
            $user->update(['name' => $request->name,]);
        }
        if (!is_null($request->password)) {
            $user->update(['password' => Hash::make($request->password),]);
        }

        $doctor->update([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone_No' => $request->phone_No,
            'qualifications' => $request->qualifications,
            'address' => $request->address,
            'rateing' => $request->rateing,
            'status' => $status,
        ]);

        return redirect()->route('admin.doctors.list')->with('msg', 'Doctor Updated Successfully')->with('type', 'primary');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $doctor = Doctor::findOrFail($id);
        $user = User::where('id', $doctor->user_id)->first();

        $doctor->delete();
        $user->delete();

        return redirect()->route('admin.doctors.list')->with('msg', 'Doctor Deleted Successfully')->with('type', 'danger');
    }
    public function restore($id)
    {
        $doctor = Doctor::withTrashed()->where('id', $id)->first();
        $user = User::where('id', $doctor->user_id)->restore();
        $doctor->restore();

        return redirect()->route('admin.doctors.list')->with('msg', 'Doctor Restored Successfully')->with('type', 'info');
    }
}
