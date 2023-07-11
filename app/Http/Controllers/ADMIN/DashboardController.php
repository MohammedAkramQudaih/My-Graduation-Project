<?php

namespace App\Http\Controllers\ADMIN;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $users = User::withTrashed();
        $patients = Patient::withTrashed();
        $doctors = Doctor::withTrashed();
        $admins = User::withTrashed()->where('role','admin');
        return view('admin.index', compact('admins','users','patients','doctors'));
    }
}
