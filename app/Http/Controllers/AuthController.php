<?php

namespace App\Http\Controllers;

use App\Http\Helpers\IpToCountry;
use App\Http\Validators\LoginValidator;
use App\Http\Validators\RegisterValidator;
use App\Models\User;
use App\Models\UserInfo;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    use LoginValidator, RegisterValidator, IpToCountry;

    public function login(Request $request): JsonResponse
    {
        try {
            $this->validations();
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials, $request->remember_me)) {
                return response()->json(['message' => 'Login successful', 'user' => Auth::user()]);
            }
            return response()->json(['message' => 'Invalid credentials'], 401);
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    public function logout(): JsonResponse
    {
        try {
            Auth::logout();
            return response()->json(['message' => 'Logout successful']);
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }

    public function register(Request $request): JsonResponse
    {
        try {
            $this->validations_register();
            $userInfo = $this->getCountry(request()->ip());
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => bcrypt($request->input('password')),
            ]);
            UserInfo::create([
                'user_id' => $user->id,
                'ip' => $userInfo['ip'],
                'country_code' => $userInfo['country_code'],
                'country_name' => $userInfo['country_name'],
                'region_name' => $userInfo['region_name'],
                'city' => $userInfo['city'],
            ]);
            DB::commit();
            Auth::login($user);
            return response()->json(['message' => 'Registration successful']);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
}
