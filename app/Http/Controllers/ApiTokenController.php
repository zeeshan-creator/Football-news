<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;


class ApiTokenController extends Controller
{
    /**
     * Update the authenticated user's API token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function update()
    {
        $token = Str::random(60);

        DB::table('users')
            ->where('id', Auth::id())
            ->limit(1)
            ->update(array('api_token' =>  hash('sha256', $token)));

        return back()->with('token',  $token);
    }
}
