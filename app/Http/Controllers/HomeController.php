<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $posts = Post::orderBy('id', 'desc')->paginate(10);

        return view('home')->withPosts($posts);
    }
}
