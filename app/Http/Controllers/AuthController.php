<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:60',
            'email' => 'required|email|max:255`|unique:users`',
            'password' => 'required|min:6'
        ]);

        DB::beginTransaction();
        try {
            $request->merge([
                'password' => app('hash')->make($request->password)
            ]);

            $user = User::create($request->only('name', 'email', 'password'));

            DB::commit();

            return response()->json([
                "status" => 201,
                "message" => "Created",
                "data" => [
                    "name" => $user->name,
                    "email" => $user->email,
                ]
            ], 201);
        } catch (\Throwable $th) {
            throw $th;
            DB::roolback();
        } catch (\Exception $e) {
            // dd($e);
            DB::roolback();
            return response()->json([
                "status" => 409,
                "message" => "User Registration Failed!",
                "data" => []
            ], 409);
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        $userFindEmail = User::where("email", $request->email)->first();

        if ($userFindEmail) {
            if (Hash::check($request->password, $userFindEmail->password)) {

                $newToken = "Dew" . str_random(40);

                $userFindEmail->update([
                    'api_token' => $newToken,
                    'last_login' => Carbon::now()
                ]);

                $response = [
                    "status" => 200,
                    "message" => "Email does not exist!",
                    "data" => [
                        "name" => $userFindEmail->name,
                        "email" => $userFindEmail->email,
                        "api_token" => $newToken
                    ]
                ];
            } else {
                $response = [
                    "status" => 401,
                    "message" => "Password does not match!",
                    "data" => []
                ];
            }
        } else {
            $response = [
                "status" => 401,
                "message" => "Email does not exist!",
                "data" => []
            ];
        }

        return response()->json($response, $response['status']);
    }

    public function me()
    {
        $user = Auth::user();

        return response()->json([
            "status" => 200,
            "message" => "success",
            "data" => $user->only('id','email','last_login')
        ], 200);
    }
}
