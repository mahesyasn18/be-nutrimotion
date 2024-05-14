<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\DailyNutrition;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ApiAuthController extends Controller
{
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => [
                'required',
                'string',
                'min:3'
            ],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'weight' => [
                'required',
                'integer'
            ],
            'height' => [
                'required',
                'integer',
            ],
            'gender' => [
                'required',
                'string'
            ],
            'birthday' => [
                'required',
                'date'
            ]
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());

        DailyNutrition::create([
                'user_id' => $user->id,
                'tanggal' => Carbon::now(),
                'kalori' => 80,
                'karbohidrat' => 90,
                'protein' => 100,
                'lemak' => 120,
                'serat' => 300,
                'air' => 0,
            ]);
        $token = $user->createToken('Bearer')->accessToken;

        $response = [
            "id" => $user->id,
            "fullname" => $user->fullname,
            "email" => $user->email,
            "email_verified_at" => $user->email_verified_at,
            "weight" => $user->weight,
            "height" => $user->height,
            "gender" => $user->gender,
            "birthday" => $user->birthday,
            'token' => $token,
            'message' => 'Registrasi berhasil',];
        return response($response, 200);
    }

    public function updateProfile (Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => [
                'required',
                'string',
                'min:3'
            ],
            'email' => 'required|string|email|max:255',

        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where("id", $request->user()->id)->first();
        $user->update($request->toArray());

        $response = [
            "id" => $user->id,
            "fullname" => $user->fullname,
            "email" => $user->email,
            "weight" => $user->weight,
            "height" => $user->height,
            "gender" => $user->gender,
            "birthday" => $user->birthday,
            'message'   => 'Update berhasil',
    ];
        return response($response, 200);
    }

    public function updatePersonalData (Request $request) {
        $validator = Validator::make($request->all(), [
            'weight' => [
                'required',
                'integer'
            ],
            'height' => [
                'required',
                'integer',
            ],
            'gender' => [
                'required',
                'string'
            ],
            'birthday' => [
                'required',
                'date'
            ]

        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where("id", $request->user()->id)->first();
        $user->update($request->toArray());

        $response = [
            'data' => $user,
            'message'   => 'Update berhasil',
    ];
        return response($response, 200);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string'],
            'password' => ['required', 'string', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, $request->user()->password);
        if($currentPasswordStatus){
            $user = User::where("id", $request->user()->id)->first();
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            $response = [
                'message'   => 'Update berhasil',
        ];
            return response($response, 200);

        }else{

            $response = [

                'message'   => 'error',
        ];
            return response($response, 422);
        }
    }


    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Bearer')->accessToken;
                $response = [
                    "id" => $user->id,
                    "fullname" => $user->fullname,
                    "email" => $user->email,
                    "email_verified_at" => $user->email_verified_at,
                    "weight" => $user->weight,
                    "height" => $user->height,
                    "gender" => $user->gender,
                    "birthday" => $user->birthday,
                    'token' => $token,
                    'message' => 'Login berhasil',
                ];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 423);
        }
    }

    public function loginadmin (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = Admin::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Bearer')->accessToken;
                $response = [
                    "name" => $user->name,
                    "email" => $user->email,
                    "token" => $token,
                    'message' => 'Login berhasil'
                ];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    public function registeradmin(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'min:3'
                ],
                'email' => [
                    'required',
                    'unique:admins',
                    'email',
                ],
                'password' => [
                    'required',
                    Password::min(8)
                    ->letters()
                    ->numbers()
                ]
            ]);
        }catch (ValidationException $e){
            return response()->json([
                'message' => 'Validasi data registrasi gagal',
                'errors' => $e->errors(),
                'response' => 422
            ], 422);
        }

        // hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        $admin = Admin::create($validatedData);
        $token = $admin->createToken('Laravel10PassportAuth')->accessToken;
        return response()->json([
            'admin' => $admin,
            'token' => $token,
            'message' => 'Registrasi akun admin berhasil',
            'response' => 200
        ]);

    }

    public function checkEmail(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        // Check if email exists in the database
        $emailExists = User::where('email', $request->email)->exists();

        return response()->json([
            'is_email_exist' => $emailExists,
        ]);
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
