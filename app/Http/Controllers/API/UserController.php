<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // use PasswordValidationRules;

    public function login(Request $request)
    {
        try {
            // validasi inputan
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            // Mengecek loginnya
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ],'Authentication Failed', 500);
            }

            // Jika hashnya tidak sesui maka beri error
            $user = \App\Models\User::where('email', $request->email)->first();
            if ( ! Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            // Jika berhasil maka loginkan
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ],'Authenticated');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ],'Authentication Failed', 500);
        }
    }
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                // 'password' => $this->passwordRules()
                'password' => 'required|confirmed'
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'no_tlp' => $request->no_tlp,
                'jenis_kelamin' => $request->jenis_kelamin,
                // 'password' => Hash::make($request->password),
                'password' => bcrypt($request->password)
            ]);

            $user = User::where('email', $request->email)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ],'User Registered');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ],'Authentication Failed', 500);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($token,'Token Revoked');
    }

    public function updateProfile(Request $request)
    {
        // $data = $request->all();
        $data = [
            'name' => $request->name,
            'no_tlp' => $request->no_tlp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ];

        $user = Auth::user();
        $user->update($data);

        return ResponseFormatter::success($user,'Profile Updated');
    }

    public function dataProfil(Request $request)
    {
        return ResponseFormatter::success($request->user(),'Data profile user berhasil diambil');
        // $data = [
        //     'name' => $request->name,
        //     'no_tlp' => $request->no_tlp,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        //     'alamat' => $request->alamat,
        // ];
        // $data = User::select('name')->get();
        // $data = DB::table('users')

        // return ResponseFormatter::success($data,'Data profile user berhasil diambil');
    }

    public function uploadPhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|image|max:2048',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(['error'=>$validator->errors()], 'Update Photo Fails', 401);
        }

        if ($request->file('file')) {

            $file = $request->file->store('assets/user', 'public');

            //store your file into database(url)
            $user = Auth::user();
            $user->photoProfile = $file;
            $user->update();

            return ResponseFormatter::success([$file],'File successfully uploaded');
        }
    }

}
