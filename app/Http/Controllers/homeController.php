<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user        =  DB::table('users')->count();
        $news        =  DB::table('news')->count();
        $promotion   =  DB::table('promotions')->count();

        return view('home.index', ['users' => $user, 'news' => $news, 'promotions' => $promotion]);
    }
}
