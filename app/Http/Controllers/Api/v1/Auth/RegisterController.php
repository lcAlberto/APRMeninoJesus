<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Actions\Root\OrganizationAction;
use App\Http\Requests\Root\OrganizationRequest;
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
use App\Http\Requests\RegisterApiRequest;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(RegisterApiRequest $request)
    {
        try {
            $data = $request->only('name', 'email', 'password', 'img_profile');
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'img_profile' => data_get($data, 'img_profile', 'no image'),
            ]);
            if ($token = $this->guard()->attempt($data)) {
                if (!$user->hasRole(UserRolesEnum::ADMIN)) {
                    $user->assignRole(UserRolesEnum::ADMIN);
                }
                event(new Registered($user));
                Auth::login($user);
                return $this->respondWithToken($token, $request->get('keep_login'), $user);
            }
            return response()->json(['error' => 'Unauthorized'], 401);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message:' => 'Internal Server Error'
            ], 500);
        }
    }
}
