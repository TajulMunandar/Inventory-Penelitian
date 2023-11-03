<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->exists('username') && $request->exists('password')) {
            $credentials = $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                return response([
                    'data' => Auth::user(),
                    'status' => '200',
                    'pesan' => 'Authentikasi Diterima!'
                ], 200);
            }
            return response([
                'status' => '404',
                'pesan' => 'Username/Password Salah!'
            ], 404);
        }
        return response([
            'status' => '404',
            'pesan' => 'Username/Password Salah!'
        ], 404);
    }
}
