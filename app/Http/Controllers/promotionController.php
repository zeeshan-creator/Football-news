<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class promotionController extends Controller
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
        $promotions = DB::table('promotions')->get();
        return view('promotion.index', ['promotions' => $promotions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('promotion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, promotion $promotion)
    {
        $data = new promotion();

        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'start_date' => 'required',
            'exp_date' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $file = $request->file('image');
        $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);

        $data['image'] = $filename;
        $data['user_id'] = Auth::id();
        $data['name'] = $request->input('name');
        $data['url'] = $request->input('url');
        $data['start_date'] = $request->input('start_date');
        $data['exp_date'] = $request->input('exp_date');

        $data->save();

        return redirect('/promotions')->with('success', 'Promotion has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(promotion $promotion)
    {
        return view('promotion.edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = promotion::find($id);
        $filename = '';

        $request->validate([
            'name' => 'required',
            'url' => 'required',
            'start_date' => 'required',
            'exp_date' => 'required',
        ]);

        if ($request->input('oldImage') != null) {
            $filename = $request->input('oldImage');
        } else {

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $file = $request->file('image');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            File::delete("images/" . $data->image);
        }

        $data->image = $filename;
        $data->name = $request->input('name');
        $data->url = $request->input('url');
        $data->clicks = $request->input('clicks');
        $data->views = $request->input('views');
        $data->start_date = $request->input('start_date');
        $data->exp_date = $request->input('exp_date');

        $data->save();

        return redirect('/promotions')->with('success', 'Promotion has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotion = promotion::find($id);
        File::delete("images/" . $promotion->image);

        promotion::find($id)->delete();

        return redirect('/promotions')->with('success', 'Promotion has been deleted successfully');
    }
}
