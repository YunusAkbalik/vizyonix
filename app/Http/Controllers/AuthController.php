<?php

namespace App\Http\Controllers;

use App\Http\Validators\LoginValidator;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use LoginValidator;

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

    public function logout(): JsonResponse | RedirectResponse
    {
        try {
            Auth::logout();
            return redirect()->route('admin_dashboard');
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
}
