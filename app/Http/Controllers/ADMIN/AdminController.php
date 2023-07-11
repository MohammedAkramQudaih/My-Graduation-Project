<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = User::withTrashed()->where('role','admin')->paginate(15);
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.admins.create');

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
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'role' => 'admin'
        ]);

        return redirect()->route('admins.list')->with('msg', 'Admin Created Successfully')->with('type', 'success');

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
        $admin = User::findOrFail($id);
        return view('admin.admins.edit', compact('admin'));
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
        $admin = user::findOrFail($id);

        $request->validate([
            // 'email' => 'required|email|unique:patients|unique:users',
            'email' => 'required|email',
            'name' => 'required|string',

        ]);
        if (!is_null($request->email)) {
            $admin->update(['email' => $request->email,]);
        }
        if (!is_null($request->name)) {
            $admin->update(['name' => $request->name,]);
        }
        if (!is_null($request->password)) {
            $admin->update(['password' => Hash::make($request->password),]);
        }
        return redirect()->route('admins.list')->with('msg', 'Admin Updated Successfully')->with('type', 'primary');

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
        $admin = User::findOrFail($id);
        $admin->delete();

        return redirect()->route('admins.list')->with('msg', 'Admin Deleted Successfully')->with('type', 'danger');
    }
    public function restore($id)
    {
        $admin = User::where('id', $id)->restore();
        return redirect()->route('admins.list')->with('msg', 'Admin Restored Successfully')->with('type', 'info');
    }
}
