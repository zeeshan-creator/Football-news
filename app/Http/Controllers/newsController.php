<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\news;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class newsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = DB::table('news')->get();
        return view('news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, news $news)
    {
        $data = new news();

        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'description' => 'required',
        ]);

        $data['user_id'] = Auth::id();
        $data['title'] = $request->input('title');
        $data['date'] = $request->input('date');
        $data['description'] = $request->input('description');
        $data->save();

        return redirect('/news')->with('success', 'News has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function show(news $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(news $news)
    {
        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, news $news)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required',
            'description' => 'required',
        ]);

        $news->fill($request->post())->save();

        return redirect('/news')->with('success', 'News has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\news  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        news::find($id)->delete();

        return redirect('/news')->with('success', 'News has been deleted successfully');
    }
}
