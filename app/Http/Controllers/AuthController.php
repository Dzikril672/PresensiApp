<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginrequest(Request $request)
    {   
        if (Auth::guard('karyawan')->attempt(['nik' => $request->nik, 'password' => $request->password]))
        {
            return redirect('/dashboard'); 
        } else {
            return redirect('/') -> with(['warning' => 'NIK atau Password yang anda masukan salah']);
        }
    }
    
    public function loginAdminRequest(Request $request)
    {   
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect('/admin/dashboardAdmin'); 
        } else {
            return redirect('/admin') -> with(['warning' => 'Email atau Password yang anda masukan salah']);
        }
    }

    public function logoutrequest(){
        if(Auth::guard('karyawan')->check()){
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }

    public function logoutrequestAdmin(){
        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
            return redirect('/admin');
        }
    }
}
