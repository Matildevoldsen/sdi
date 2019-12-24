<?php

namespace App\Http\Controllers;

use App\Post;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::find(1);

        if (!Auth::guest() && Auth::user()->is_admin == 1) {
            $posts = Post::orderBy('id', 'desc')->paginate(10);
            return view('home')->withPosts($posts)->withSetting($setting);
        } else {
            $posts = Post::orderBy('id', 'desc')->paginate(10);
            return view('home')->withPosts($posts)->withSetting($setting);
        }

    }
}
