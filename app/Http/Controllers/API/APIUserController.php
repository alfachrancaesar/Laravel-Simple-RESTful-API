<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class APIUserController extends Controller
{
	//untuk GET data user (read)
    public function index(){
    	$users = User::all();
    	return response()->json(['data'=>$users]);
    }

    //untuk POST data user (create, update)
    public function store(Request $request) {
    	try{
    		$user = User::create($request->all());
    		return response()->json(['sukses'=>true]);
    	} 
    	catch(Exception $e){
    		return response()->json(['sukses'=>false, 'eror'=>'eror'.$e]);
    	}
    }

    //untuk PUT data user (update)
    public function update(Request $request, $id){
    	try{
    		$user = User::find($id);
    		$data['name'] = $request->name;
    		$data['email'] = $request->email;
    		$data['password'] = bcrypt($request->password);
    		$user->update($data);
    		return response()->json(['sukses'=>true]);
    	}
    	catch(Exception $e){
    		return response()->json(['sukses'=>false, 'eror'=>'eror'.$e]);
    	}
    }

    //untuk DELETE data user (delete)
    public function delete($id){
    	try{
    		$user = User::find($id);
    		$user->delete();
    		return response()->json(['sukses'=>true]);
    	}
    	catch(Exception $e){
    		return response()->json(['sukses'=>false, 'eror'=>'eror'.$e]);
    	}
    }
}
