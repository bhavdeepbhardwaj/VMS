<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class APIController extends Controller
{
    public function login(Request $request) {

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $token = auth()->user()->createApiToken(); #Generate token
            return response()->json(['status' => 'Authorized', 'token' => $token ], 200);
        } else {
            return response()->json(['status'=>'Unauthorized'], 401);
        }
    }

    public function index() {
        $users = User::get();

        if($users->count()) {
            return response()->json(['status' => 'true' ,'data' => $users], 200);
        } else{
            return response()->json(['status' => 'false'], 401);
        }
    }
}
