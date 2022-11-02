<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class API_userController extends Controller
{
    private $user;

    public function __construct(Request $request)
    {
        try {
            if (!$this->user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status' => 'Token is Invalid']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['status' => 'Token is Expired']);
            } else {
                return response()->json(['status' => 'Authorization Token not found']);
            }
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }

    public function index()
    {
        // return User::all();
    }

    public function store(Request $request)
    {
        $first_name =      $request->input('first_name');
        $last_name =      $request->input('last_name');
        $email =      $request->input('email');
        $password =      $request->input('password');

        // Validate
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return  response()->json(['msg' => $validator->messages('*')], 422);
        }

        $ifEmailExists = DB::table('users')->where('email', '=', $email)->get();

        if (!$ifEmailExists->isEmpty()) {
            return  response()->json(['msg' => 'Email already exists!'], 422);
        }

        $data = new User();
        $api_token = Str::random(60);
        $data['api_token']  = hash('sha256', $api_token);
        $data['first_name']  = $first_name;
        $data['last_name']   = $last_name;
        $data['email']       = $email;
        $data['password']    = Hash::make($password);
        $data->save();

        $res = [
            'msg' => 'sign up successfull!',
            'Api_token' => $api_token,
            'Description' => 'Copy this api_token to use the APIs.'
        ];

        return  response()->json($res, 201);
    }

    public function show(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return  response()->json(['msg' => $validator->messages('*')->first()], 422);
        }

        if (!$token = JWTAuth::attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = JWTAuth::user();
        $token = JWTAuth::fromUser($user);

        $user_id = JWTAuth::user()->id;

        return response()->json(compact('token'), 201);
    }

    public function update(Request $request)
    {
        $first_name =      $request->input('first_name');
        $last_name =      $request->input('last_name');
        $email =      $request->input('email');
        $password =      $request->input('password');


        $user_id = $this->user['id'];

        try {
            $data = User::findOrFail($user_id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['msg' => 'User doesn\'t exist'], 404);
        }

        $data['first_name']  = isset($first_name) ? $first_name : $data['first_name'];
        $data['last_name']   = isset($last_name) ? $last_name : $data['last_name'];
        $data['email']       = isset($email) ? $email : $data['email'];
        $data['password']    = isset($password) ? Hash::make($password) :  $data['password'];
        $data->save();

        return response()->json(['msg' => 'Updated successfully!'], 202);
    }

    public function destroy($id)
    {
        // $User = User::findOrFail($id);
        // $User->delete();
        // return response()->json(null, 204);
    }
}
