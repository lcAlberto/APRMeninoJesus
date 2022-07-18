<?php

namespace App\Http\Controllers\Api\v1;


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

class AuthController extends Controller
{
    private $action = null;
    private $user = null;

    public function __construct()
    {
        $this->middleware(
            'jwt.auth', ['except' => ['login', 'register']]);
        $this->action = new OrganizationAction();
        $this->user = new User();
    }

    public function welcome()
    {
        return response()->json($this->guard()->user());
    }

    public function login(LoginApiRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if ($token = $this->guard()->attempt($credentials)) {
                return $this->respondWithToken($token, $request->get('keep_login'));
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

    protected function respondWithToken($token, $keepLogin = false, $user = null)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'keep_login' => $keepLogin,
            'user' => $user ? $user :  response()->json($this->guard()->user())
        ]);
    }

    public function createOrganization(OrganizationRequest $request)
    {
        try {
            $data = $request->all();
            $organization = $this->action->createOrganization($data);
            if($this->guard()->user()->organization_id === null) {
                $this->enableOrganization($organization);
            }
            return [
                'status' => '200',
                'data' => $organization
            ];
        } catch (\Exception $e) {
            return $e;
        }
    }


    public function enableOrganization($organization)
    {
        $user = $this->user->findOrFail($this->guard()->user()->id);
        $data['organization_id'] = $organization->id;
        $user->update($data);
    }

    public function guard()
    {
        return Auth::guard();
    }
}
