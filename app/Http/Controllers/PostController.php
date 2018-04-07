<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth', [
            'only' => [
                'store', 'update', 'delete'
            ]
        ]);

        $this->kv = [
            'claim' => '申报对象',
            'information' => '资讯',
            'faq' => 'FAQ',
            'case' => '案例'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:claim,information,faq,case'
        ], [], [
            'type' => '类型'
        ]);

        $data = collect();
        $data->type = $request->type;
        $data->type_name = $this->kv[$request->type];
        $data->list = Post::with(['admin'])->without('content')->where('type', $request->type)->orderBy('updated_at', 'desc')->get();

        return view('post.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'type' => 'required|string|in:claim,information,faq,case'
        ], [], [
            'type' => '类型'
        ]);

        $data = collect();
        $data->type = $request->type;
        $data->type_name = $this->kv[$request->type];

        return view('post.create', ['data' => $data]);
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
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'content' => 'string'
        ], [], [
            'title' => '标题',
            'type' => '文章类型',
            'content' => '内容'
        ]);
        $imgs = null;
        if($request->hasFile('imgs')){
            $imgs = array_map(function($image){
                if($image->isValid()){
                    return [
                        'name' => $image->getClientOriginalName(),
                        'path' => $image->store('imgs', 'public')
                    ];
                }else{
                    return null;
                }
            }, $request->file('imgs'));
            $imgs = array_filter($imgs, function($item){
                return !is_null($item);
            });
        }

        $post = Post::create(array_merge($request->all(), [
            'admin_id' => Auth::id(),
            'images' => json_encode($imgs, JSON_UNESCAPED_UNICODE)
        ]));

        return redirect('/post?type='.$request->type);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post->type_name = $this->kv[$post->type];
        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'content' => 'string'
        ], [], [
            'title' => '标题',
            'type' => '文章类型',
            'content' => '内容'
        ]);

        $imgs = null;
        if($request->hasFile('imgs')){
            $imgs = array_map(function($image){
                if($image->isValid()){
                    return [
                        'name' => $image->getClientOriginalName(),
                        'path' => $image->store('imgs', 'public')
                    ];
                }else{
                    return null;
                }
            }, $request->file('imgs'));
            $imgs = array_filter($imgs, function($item){
                return !is_null($item);
            });
        }

        $post->fill(array_merge($request->all(), [
            'admin_id' => Auth::id(),
            'images' => $imgs
        ]))->save();

        return redirect('/post?type='.$request->type);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
    }


    public function list(Request $request){
        $request->validate([
            'type' => 'required|string|in:claim,information,faq,case'
        ], [], [
            'type' => '类型'
        ]);

        $data = Post::where('type', $request->type)->orderBy('updated_at', 'desc')->select(['title', 'id', 'updated_at', 'type'])->get();
        $type_name = $this->kv[$request->type];

        return view('post.list', [
            'data' => $data,
            'type_name' => $type_name
        ]);
    }
}
