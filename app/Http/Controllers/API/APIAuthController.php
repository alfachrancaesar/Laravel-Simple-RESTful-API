<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exception\JWTException;

class APIAuthController extends Controller
{
    public function login(Request $request) {
    	try {
    		$credentials = $request->only('email', 'password'); //menggunakan credentials email dan password
    		$token = JWTAuth::attempt($credentials); //jika credentials valid, maka token ter-generate
    		if(!$token) {
    			return response()->json(['sukses'=>false, 'pesan'=>'Invalid Credentials'], 404);
    		} //jika credentials tidak valid, maka error 404
    	} 
    	catch(Exception $e){ //catch digunakan jika ada kesalahan pada try
    		return response()->json(['sukses'=>false, 'pesan'=>'Gagal Login'], $e->getStatusCode());
    	}
    	return response()->json(['sukses'=>true, 'pesan'=>'Berhasil Login', 'token'=>$token], 200);
    }

    public function logout(Request $request) {
    	try {
    		$this->validate($request, ['token'=>'required']);
    		JWTAuth::invalidate($request->input('token'));
    		return response()->json(['sukses'=>true, 'pesan'=>'Berhasil Logout']);
    	}
    	catch(Exception $e) {
    		return response()->json(['sukses'=>false, 'pesan'=>'Gagal Logout'], $e->getStatusCode());
    	}
    }
}
