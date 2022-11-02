<?php

namespace App\Http\Controllers;

use App\Models\news;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use function PHPUnit\Framework\isEmpty;

class API_newsController extends Controller
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

        // $news = DB::table('news')->where('user_id', '=',  $this->user['id'])->get();
        $news = DB::table('news')->get();
        return $news;
    }

    public function show(Request $request, $id)
    {

        $news = DB::table('news')->where('user_id', '=',  $this->user['id'])->where('id', '=', $id)->get();
        if ($news->isEmpty()) {
            return  response()->json(['msg' => 'id doesn\'t exist or not accesible'], 422);
        }
        return $news;
    }

    public function store(Request $request)
    {
        // Validate
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'date' => 'required|date_format:Y-m-d',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return  response()->json(['msg' => $validator->messages('*')], 422);
        }



        $data = new news();
        $data['user_id'] =  $this->user['id'];
        $data['title'] = $request->input('title');
        $data['date'] = $request->input('date');
        $data['description'] = $request->input('description');
        $data->save();

        return  response()->json(['msg' => 'Saved successfully!'], 201);
    }

    public function update(Request $request, $id)
    {

        $title = $request->input('title');
        $date = $request->input('date');
        $description = $request->input('description');

        try {
            $data = news::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['msg' => 'id doesn\'t exist'], 404);
        }

        if ($data['user_id'] !=  $this->user['id']) {
            return response()->json(['msg' => 'not accesible'], 404);
        }

        $data['title'] = isset($title) ? $title : $data['title'];
        $data['date'] = isset($date) ? $date : $data['date'];
        $data['description'] = isset($description) ? $description : $data['description'];

        $data->save();

        return response()->json(['msg' => 'Updated successfully!'], 202);
    }

    public function destroy(Request $request, $id)
    {

        try {
            $data = news::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['msg' => 'id doesn\'t exist'], 404);
        }

        if ($data['user_id'] !=  $this->user['id']) {
            return response()->json(['msg' => 'not accesible'], 422);
        }

        $data->delete();

        return response()->json(['msg' => 'Deleted successfully!'], 200);
    }
}
