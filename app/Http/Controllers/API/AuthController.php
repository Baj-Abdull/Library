<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Models\User;
use App\Models\Librarian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\SessionGuard;


class AuthController extends Controller
{
    public function register(RegisterRequest $request){ // changed from 'Request $request' to 'UserRequest $request'

    // $validator = Validator::make($request->all(),[
    //     "name" => "required",
    //     "email" => "required|email",
    //     "password" => "required",
    //     "confirm_password" => "required|same:password"
    // ]);
    
    
    // $request->validator();
    
    // if($validator->fails()){
    //     return response()->json([
    //         "status" => 0,
    //         "message" => "validation errors.",
    //         "data" => $validator->errors()->all()
    //     ]);
    // }

    $user = User::create(attributes: $request->validated());

    // $user = User::create([
    //     "name" => $request->name,
    //     "email" => $request->email,
    //     "password" => bcrypt($request->password),
    //     // 'token' => createToken("MyApp")->plainTextToken,
    // ]);
    
    // $response = [];
    // $response["token"] = $user->createToken("MyApp")->plainTextToken;
    // $response["name"] = $user->name;
    // $response["email"] = $user->email;
    
    return response()->json([ 
        "status" => 1,
        "message" => "user registered",
        "data" => $user
    ]);
    
    
    }

    public function login(LoginRequest $request){
        $request->validated();
        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $response = [];
            $response['user'] = $request->all();
            $response['token'] = $user->createToken("user")->plainTextToken;
            return response()->json([
                "status" => 1,
                "message" => "user login",
                "data" => $response,
            ]);
        }
        
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Change this:
            // $librarian = Auth::user(); //By default, Auth::user() looks for a user in the default guard (usually web), 
            // not the specific guard you just used.

            // To this:
            $librarian = Auth::guard('admin')->user();
            $response = [];
            $response['admin'] = $request->all();
            $response['token'] = $librarian->createToken("admin")->plainTextToken;
            return response()->json([
                "status" => 1,
                "message" => "user login",
                "data" => $response,
            ]);
        }
            return response()->json([
                "status" => 404,
                "message" => "user NOT login",
                "data" => null,
            ]);
        


        
        // $user = Auth::user();
        // $user = $request->all();
        // $user = $request->bearerToken();
        // $response = [];
        // $response["user"] = $user;

    }

   
    public function logout(LogoutRequest $request){
        
        
        $request->user()->currentAccessToken()->delete();
        
        return response()->json([
                "status" => 1,
                "message" => "User logout"
                
        ]);

    }

}