<?php

namespace App\Http\Controllers\Api\v1;


use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Enums\UserRolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginApiRequest;
use App\Models\User;
use function PHPUnit\Framework\returnArgument;
use RegisterApiRequest;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'jwt.auth', ['except' => ['login', 'register']]);
    }

    public function wellcome()
    {
        return response()->json($this->guard()->user());
    }

    public function login(LoginApiRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if ($token = $this->guard()->attempt($credentials)) {
                return $this->respondWithToken($token, $request->get('remember'));
            }
            return response()->json(['error' => 'Unauthorized'], 401);
        } catch (Exception $error) {
            return response()->json([
                'error' => 'Erro',
                'message:' => $error->getMessage()
            ], $error->getCode());
        }

    }

    public function register(RegisterApiRequest $request)
    {
        try {
            $data = $request->validated();
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);
            if ($token = $this->guard()->attempt($data)) {
                if (!$user->hasRole(UserRolesEnum::ADMIN)) {
                    $user->assignRole(UserRolesEnum::ADMIN);
                }
                event(new Registered($user));
                Auth::login($user);
                return $this->respondWithToken($token, true);
            }
            return response()->json(['error' => 'Unauthorized'], 401);
        } catch (Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message:' => 'Internal Server Error'
            ], 500);
        }
    }

    public function me()
    {
        return response()->json($this->guard()->user());
    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token, $keepLogin = false)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'keep_login' => $keepLogin
        ]);
    }

    public function guard()
    {
        return Auth::guard();
    }
}
