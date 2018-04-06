<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function __construct(){
        // $this->middleware('auth');
    }

    public function index(Request $request){
        $request->validate([
            'image' => 'required|file|image'
        ], [], [
            'image' => '上传文件'
        ]);

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $image = $request->image;
            $name = $image->getClientOriginalName();
            $path = $image->store('images', 'public');

            return [
                'code' => 0,
                'data' => [
                    'name' => $name,
                    'url' => $path
                ]
            ];
        }else{
            throw new Exception('图片上传失败');
        }
    }
}
