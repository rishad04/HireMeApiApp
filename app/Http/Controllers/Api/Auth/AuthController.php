<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            // 'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // dd($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => Role::where('slug', 'job-seeker')->value('id')
        ]);

        $token = Auth::guard('api')->login($user);

        // return response()->json(auth('api')->user());

        $tokenData = $this->createNewToken($token)->getData(true);
        $tokenData['message'] = 'User successfully registered';

        return response()->json($tokenData, 201);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $tokenData = $this->createNewToken($token)->getData(true);
        $tokenData['message'] = 'Login Successful!';

        return response()->json($tokenData, 200);
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // The token expiration time is set in your config/jwt.php file (in minutes)
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user() // Optionally return user details
        ]);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    public function refresh()
    {
        return $this->createNewToken(auth('api')->refresh());
    }

    public function getProfile()
    {
        return response()->json(auth('api')->user());
    }
}
