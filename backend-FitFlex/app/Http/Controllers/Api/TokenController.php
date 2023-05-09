<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\Role;
use App\Models\Suscripcion;
use Carbon\Carbon;

class TokenController extends Controller
{
    public function user(Request $request) 
    {
        $user = User::where('email', $request->user()->email)->first();

        return response()->json([
            "success" => true,
            "user"    => $request->user(),
            "roles"   => $user->getRoleNames(),
        ]);
    }

   /*  public function updateUser( $request, $id)
    {
        $user = User::find($id);

        if (empty($user)) {
            return response()->json([
                'success'  => false,
                'message' => 'User not found'
            ], 404);
        }

        $validatedData = $request->validate([
            "name"      => "required|string|max:255",
            "email"     => "required|string|email|max:255|unique:users",
            "password"  => "required|string|min:8"
        ]);

        $user = User::create([
            "name"      => $validatedData["name"],
            "email"     => $validatedData["email"],
            "password"  => Hash::make($validatedData["password"]),
        ]);
        if ($validatedData) {
            Log::debug("Updating DB...");
            $user->name    = $validatedData['name'];
            $user->email   = $validatedData['email'];
            $user->password   = $validatedData['password'];
            $user->save();
            Log::debug("DB storage OK");
            return response()->json([
                'success' => true,
                'data'    => $user
            ], 200);
        } else {
            return response()->json([
                'success'  => false,
                'message' => 'Error uploading User'
            ], 500);
        }
    } */

    public function register(Request $request) 
    {
        $validatedData = $request->validate([
            "name"      => "required|string|max:255",
            "email"     => "required|string|email|max:255|unique:users",
            "password"  => "required|string|min:8"
        ]);
        
        $user = User::create([
            "name"      => $validatedData["name"],
            "email"     => $validatedData["email"],
            "password"  => Hash::make($validatedData["password"]),
        ]);
        
        $user->assignRole(Role::USUARIO);

        // event(new \Illuminate\Auth\Events\Registered($user));
        
        // $user->sendEmailVerificationNotification();

        return $this->_generateTokenResponse($user);
    }

    public function login(Request $request) 
    {
        $credentials = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);
 
        if (Auth::attempt($credentials)) {

            // Get user
            $user = User::where([
                ["email", "=", $credentials["email"]]
            ])->firstOrFail();
            // Revoke all old tokens
            $user->tokens()->delete();
           
            // Check subscription
            $suscripcion = Suscripcion::find($user->id_suscripcion);
            
            if ($suscripcion && Carbon::parse($suscripcion->fecha_fin)->lte(Carbon::now())) {
                // El usuario no tiene una suscripción válida
                $user->removeRole(Role::PREMIUM);
                $user->assignRole(Role::USUARIO);
                $user->save();
            }

            // Generate new token
            return $this->_generateTokenResponse($user); 

        } else {
            return response()->json([
                "success" => false,
                "message" => "Invalid login credentials"
            ], 401);
        }
    }

    public function logout(Request $request) 
    {
        // Revoke token used to authenticate current request...
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "success" => true,
            "message" => "Current token revoked",
        ]);
    }

    protected function _generateTokenResponse(User $user)
    {
        $token = $user->createToken("authToken")->plainTextToken;

        return response()->json([
            "success"   => true,
            "authToken" => $token,
            "tokenType" => "Bearer"
        ], 200);
    }
}
