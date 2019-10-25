<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostController extends Controller
{
    public function index() {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('posts.index')->withPosts($posts);
    }

    public function create() {

    }

    public function store() {

    }

    public function edit() {

    }

    public function update() {

    }

    public function delete() {

    }
}
