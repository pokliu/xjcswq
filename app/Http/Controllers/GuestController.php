<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class GuestController extends Controller
{
    //

    public function index(){

        $banner = Post::where('type', 'information')->whereNotNull('images')->select(['images', 'title', 'id'])->orderBy('updated_at', 'desc')->take(5)->get();
        $banner = $banner->map(function($item){
            return count($item->images) > 0 ? [
                'src' => $item->images[0]['path'],
                'title' => $item->title,
                'id' => $item->id
            ]: null;
        })->filter(function($item){
            return !is_null($item);
        });

        $claims = Post::where('type', 'claim')->select(['id', 'title'])->orderBy('updated_at', 'desc')->take(20)->get();
        $informations = Post::where('type', 'information')->select(['id', 'title', 'updated_at'])->orderBy('updated_at', 'desc')->take(6)->get();
        $faqs = Post::where('type', 'faq')->select(['id', 'title'])->orderBy('updated_at', 'desc')->take(6)->get();

        return view('welcome', [
            'banner' => $banner,
            'claims' => $claims,
            'informations' => $informations,
            'faqs' => $faqs
        ]);
    }
}
