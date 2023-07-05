<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $patients = Patient::withTrashed()->paginate(15);
        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:patients|unique:users',
            'name' => 'required|string',
            'password' => ['required'],
            'gender' => ['required'],
            // 'phone_No' => ['numeric'],
            'age' => ['nullable'],
            'image' => ['file'],

        ]);

        $imageName = '';
        $file = $request->file('image');
        if (!is_null($file)) {
            $ex = $file->getClientOriginalExtension();
            $imageName = 'patientImage' . rand() . time() . '.' . $ex;
            $file->move(public_path('adminimages/patient/'), $imageName);
            // $patient->update(['image' => $imageName,]);
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'role' => 'patient'
        ]);
        Patient::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone_No' => $request->phone_No,
            'age' => $request->age,
            'image' => $imageName,
            'address' => $request->address,
            'gender' => $request->gender,
            'diabetic_type' => $request->diabetic_type,
            'patient_status' => $request->patient_status
        ]);

        return redirect()->route('admin.patients.list')->with('msg', 'Patient Created Successfully')->with('type', 'success');
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
        $patient = Patient::findOrFail($id);
        return view('admin.patients.edit', compact('patient'));
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
        $patient = Patient::findOrFail($id);
        $user = User::where('id', $patient->user_id)->first();

        $request->validate([
            // 'email' => 'required|email|unique:patients|unique:users',
            'email' => 'required|email',
            'name' => 'required|string',
            // 'password' => ['required'],
            'gender' => ['required'],
            // 'phone_No' => ['numeric'],
            'age' => ['nullable'],
            'image' => ['file'],

        ]);

        $imageName = $patient->image;;
        $file = $request->file('image');
        if (!is_null($file)) {
            $ex = $file->getClientOriginalExtension();
            $imageName = 'patientImage' . rand() . time() . '.' . $ex;
            $file->move(public_path('adminimages/patient/'), $imageName);
            $patient->update(['image' => $imageName,]);
        }

        if (!is_null($request->email)) {
            $user->update(['email' => $request->email,]);
        }
        if (!is_null($request->name)) {
            $user->update(['name' => $request->name,]);
        }
        if (!is_null($request->password)) {
            $user->update(['password' => Hash::make($request->password),]);
        }

        $patient->update([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone_No' => $request->phone_No,
            'age' => $request->age,
            // 'image' => $imageName,
            'address' => $request->address,
            'gender' => $request->gender,
            'diabetic_type' => $request->diabetic_type,
            'patient_status' => $request->patient_status
        ]);

        return redirect()->route('admin.patients.list')->with('msg', 'Patient Updated Successfully')->with('type', 'primary');


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
        $patient = Patient::findOrFail($id);
        $user = User::where('id', $patient->user_id)->first();

        $patient->delete();
        $user->delete();

        return redirect()->route('admin.patients.list')->with('msg', 'Patient Deleted Successfully')->with('type', 'danger');
    }
    public function restore($id)
    {
        $patient = Patient::withTrashed()->where('id', $id)->first();
        $user = User::where('id', $patient->user_id)->restore();
        $patient->restore();

        return redirect()->route('admin.patients.list')->with('msg', 'Patient Restored Successfully')->with('type', 'info');
    }
}
