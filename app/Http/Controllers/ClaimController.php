<?php

namespace App\Http\Controllers;

use App\Claim;
use Illuminate\Http\Request;
use App\Post;

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
        $claims = Claim::with(['post'])->orderBy('updated_at')->get();
        return view('claim/index', ['claims' => $claims]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $options = Post::where('type', 'claim')->select(['title', 'id'])->orderBy('updated_at', 'desc')->get();

        return view('claim.create', [
            'options' => $options,
            'id' => $request->id,
            'status' => $request->status
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'captcha' => 'required|captcha',
            'post_id' => 'required|numeric|exists:posts,id',
            'name' => 'string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
            'location' => 'required|string|max:255',
            'bought_time' => 'required|string',
            'sold_time' => 'required|string',
            'description' => 'required|string'
        ], [], [
            'captcha' => '验证码',
            'post_id' => '申报对象',
            'name' => '姓名',
            'phone' => '电话',
            'email' => 'email地址',
            'location' => '省份与地区',
            'bought_time' => '购买时间',
            'sold_time' => '卖出时间',
            'description' => '备注'
        ]);

        $claim = Claim::create($request->all());

        return redirect('/claim/create?status=success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Claim  $claim
     * @return \Illuminate\Http\Response
     */
    public function show(Claim $claim)
    {
        return view('claim.show', ['claim' => $claim]);
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
        $request->validate([
            'captcha' => 'required|captcha',
            'post_id' => 'required|numeric|exists:posts,id',
            'name' => 'string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
            'location' => 'required|string|max:255',
            'bought_time' => 'required|string',
            'sold_time' => 'required|string',
            'description' => 'required|string'
        ], [], [
            'captcha' => '验证码',
            'post_id' => '申报对象',
            'name' => '姓名',
            'phone' => '电话',
            'email' => 'email地址',
            'location' => '省份与地区',
            'bought_time' => '购买时间',
            'sold_time' => '卖出时间',
            'description' => '备注'
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

        return redirect('/claim');
    }
}
