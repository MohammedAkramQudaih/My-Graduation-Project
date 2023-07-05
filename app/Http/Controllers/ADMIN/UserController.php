<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $users = User::withTrashed()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
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
        $request->validate([
            'name' => 'required',
            // 'role' => 'required',
            // 'email' => ['email','unique:users'],
            // 'password' => ['required','']


        ]);
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            // 'role' => $request->role,
            // 'email' => $request->email,

        ]);
        if (!is_null($request->password)) {
            if (Hash::check($request->oldpassword, $user->password)) {
                # code...
                $user->update(['password' => Hash::make($request->password)]);
            }
            // Hash::check($request->oldpassword, $user->password); 

            // $user->update(['password' => Hash::make($request->password)]);
        }

        // $patient = Patient::where('user_id', $id)->first();
        // $patient->update(['email' => $request->email]);

        return redirect()->route('admin.users.list')->with('msg', 'User Updated Successfully')->with('type', 'primary');
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
        $user = User::findOrFail($id);
        $patient = null;
        $doctor = null;

        if ($user->role == 'patient') {
            $patient = Patient::where('user_id', $id)->first();
            if ($patient) {
                $patient->delete();
            }
        } elseif ($user->role == 'doctor') {
            $doctor = Doctor::where('user_id', $id)->first();
            if ($doctor) {
                $doctor->delete();
            }
        }

        $user->delete();

        return redirect()->route('admin.users.list')->with('msg', 'User Deleted Successfully')->with('type', 'danger');
    }

    public function restore($id)
    {
        //
        $user = User::withTrashed()->find($id);

    if ($user->role == 'patient') {
        $patient = Patient::withTrashed()->where('user_id', $id)->first();
        $patient->restore();
    } elseif ($user->role == 'doctor') {
        $doctor = Doctor::withTrashed()->where('user_id', $id)->first();
        $doctor->restore();
    }

    $user->restore();

        return redirect()->route('admin.users.list')->with('msg', 'User Restored Successfully')->with('type', 'info');
    }
}
