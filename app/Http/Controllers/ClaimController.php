<?php

namespace App\Http\Controllers;

use App\Claim;
use Illuminate\Http\Request;

class ClaimController extends Controller
{

    public function __construct(){
        $this->middleware('auth', [
            'only' => [
                'index', 'show', 'delete'
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('claim/index');
        $request->validate([
            'page' => 'numeric',
            'perPage' => 'numeric'
        ], [], [
            'page' => '页码',
            'perPage' => '每页数目'
        ]);

        return Claim::orderBy('updated_at', 'desc')->paginate($request->perPage? $request->perPage: 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate([
            'captcha' => 'required|captcha',
            'post_id' => 'required|numeric|exists:posts',
            'name' => 'string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
            'location' => 'required|string|max:255',
            'bought_time' => 'required|date',
            'sold_time' => 'required|date|after:bought_time',
            'description' => 'string'
        ], [], [
            'captcha' => '验证码',
            'post_id' => '投诉对象',
            'name' => '姓名',
            'phone' => '电话',
            'email' => '电子邮箱',
            'description' => '描述'
        ]);

        $claim = Claim::create($request->all());

        return $claim;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function show(Claim $claim)
    {
        return $claim;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function edit(Claim $claim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Claim $claim)
    {
        $this->validate([
            'captcha' => 'required|captcha',
            'post_id' => 'required|numeric|exists:posts',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
            'location' => 'required|string|max:255',
            'bought_time' => 'required|date',
            'sold_time' => 'required|date|after:bought_time',
            'description' => 'string'
        ], [], [
            'captcha' => '验证码',
            'post_id' => '投诉对象',
            'name' => '姓名',
            'phone' => '电话',
            'email' => '电子邮箱',
            'description' => '描述'
        ]);

        $claim->fill($request->all())->save();

        return $claim;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function destroy(Claim $claim)
    {
        $claim->delete();

        return [];
    }
}
