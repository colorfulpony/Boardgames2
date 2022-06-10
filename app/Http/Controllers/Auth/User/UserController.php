<?php

namespace App\Http\Controllers\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest\UserLoginRequest;
use App\Http\Requests\UserRequest\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(UserRegisterRequest $userRegisterRequest)
    {
        if ($userRegisterRequest->validated()) {
            try {
                $user = new User();
                $user->name = $userRegisterRequest->input('name');
                $user->email = $userRegisterRequest->input('email');
                $user->password = Hash::make($userRegisterRequest->input('password'));
                $user->save();

                $success = true;
                $message = 'User register successfully';
            } catch (QueryException $ex) {
                $success = false;
                $message = $ex->getMessage();
            }
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);
    }

    public function login(UserLoginRequest $userLoginRequest)
    {
        if ($userLoginRequest->has(['email', 'password'])) {
            $credentials = [
                'email' => $userLoginRequest->input('email'),
                'password' => $userLoginRequest->input('password'),
            ];
        }

        if (Auth::attempt($credentials)) {
            $success = true;
            $message = 'User login successfully';
            $role_id = Auth::user()->role_id;
        } else {
            $success = false;
            $message = 'Unauthorised';
        }

        $response = [
            'userRoleId' => $role_id,
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    public function logout()
    {
        try {
            Auth::guard('web')->logout();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

}
