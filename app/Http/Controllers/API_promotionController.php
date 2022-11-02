<?php

namespace App\Http\Controllers;

use App\Models\promotion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class API_promotionController extends Controller
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

    public function test()
    {
        return  $this->user['id'];
    }

    public function index(Request $request)
    {
        $promotion = DB::table('promotions')->get();
        return $promotion;
    }

    public function show(Request $request, $id)
    {

        $promotion = DB::table('promotions')->where('user_id', '=', $this->user['id'])->where('id', '=', $id)->get();
        if ($promotion->isEmpty()) {
            return  response()->json(['msg' => 'id doesn\'t exist or not accesible'], 422);
        }
        return $promotion;
    }

    public function store(Request $request)
    {
        // Validate
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'required|max:255',
            'start_date' => 'required|date_format:Y-m-d',
            'exp_date' => 'required|date_format:Y-m-d',
        ]);
        if ($validator->fails()) {
            return  response()->json(['msg' => $validator->messages('*')], 422);
        }



        $file = $request->file('image');
        $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);

        $data = new promotion();
        $data['user_id'] = $this->user['id'];
        $data['name'] = $request->input('name');
        $data['image'] = $filename;
        $data['url'] = $request->input('url');
        $data['start_date'] = $request->input('start_date');
        $data['exp_date'] = $request->input('exp_date');
        $data->save();

        return   response()->json(['msg' => 'Saved successfully!'], 201);
    }

    public function update(Request $request, $id)
    {

        // Validate
        $validator = Validator::make($request->all(), [
            'name' => ' max:255',
            'image' => ' image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => ' max:255',
            'start_date' => 'date_format:Y-m-d',
            'exp_date' => 'date_format:Y-m-d',
        ]);
        if ($validator->fails()) {
            return  response()->json(['msg' => $validator->messages('*')], 422);
        }


        $name = $request->input('name');
        $url = $request->input('url');
        $start_date = $request->input('start_date');
        $exp_date = $request->input('exp_date');
        $filename = '';

        try {
            $data = promotion::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['msg' => 'id doesn\'t exist'], 404);
        }

        if ($data->user_id != $this->user['id']) {
            return response()->json(['msg' => 'not accesible'], 404);
        }

        if (!empty($request->file('image'))) {
            $file = $request->file('image');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            File::delete("images/" . $data->image);
        } else {
            $filename =  $data->image;
        }

        $data->name = isset($name) ? $name : $data->name;
        $data->image = $filename;
        $data->url = isset($url) ? $url : $data->url;
        $data->start_date = isset($start_date) ? $start_date : $data->start_date;
        $data->exp_date = isset($exp_date) ? $exp_date : $data->exp_date;

        $data->save();

        return response()->json(['msg' => 'Updated successfully!'], 202);
    }

    public function destroy(Request $request, $id)
    {

        try {
            $data = promotion::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['msg' => 'id doesn\'t exist'], 404);
        }

        if ($data['user_id'] !=  $this->user['id']) {
            return response()->json(['msg' => 'not accesible'], 422);
        }

        File::delete("images/" . $data->image);
        $data->delete();

        return response()->json(['msg' => 'Deleted successfully!'], 200);
    }
}
