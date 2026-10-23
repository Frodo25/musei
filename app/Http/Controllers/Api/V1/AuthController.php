<?php   
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'       => ['required', 'email'],
            'password'    => ['required'],
            'device_name' => ['required', 'string', 'max:100'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Неверный e-mail или пароль'],
            ]);
        }

        // Выдаем права (abilities) в зависимости от роли
        $abilities = in_array($user->role ?? '', ['admin', 'editor']) ? ['read', 'write'] : ['read'];
        
        $token = $user->createToken($data['device_name'], $abilities)->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => new UserResource($user),
        ], 201);
    }

    public function logout(Request $request)
    {
        // Удаляем тот токен, с которым пришел текущий запрос
        $request->user()->currentAccessToken()->delete();
        
        return response()->noContent();
    }

    public function me(Request $request)
    {
        return new UserResource($request->user());
    }
}