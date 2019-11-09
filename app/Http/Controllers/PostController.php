<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\User;
use Faker\Provider\Image;
use Illuminate\Support\Facades\Session;
use Mews\Purifier\Purifier;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        return view('posts.index')->withPosts($posts);
    }

    public function create()
    {
        if (!Auth::guest() && Auth::user()->is_admin) {
            $categories = Category::all();
            return view('blog.index')->withCategories($categories);
        }
    }

    public function store(Request $request)
    {
        // validate the data
        $validate = $this->validate($request, array(
            'title_dk'         => 'required|max:255',
            'slug'          => 'required|alpha_dash|min:3|max:255|unique:posts,slug',
            'category_id'   => 'required|integer',
            'content_dk'          => 'required|min:50'
        ));

        if ($validate) {
            // store in the database
            $post = new Post;
            $post->title_dk = $request->title_dk;
            $post->slug = $request->slug;
            $post->category_id = $request->category_id;
            $post->meta_title_dk = $request->title_dk;
            $post->meta_desc_dk = $request->meta_desc_dk;
            $post->content_dk = html_entity_decode($request->content_dk);
            $imageName = $request->thumbnail;

            $request->thumbnail->move(public_path('public/thumbnail'), $imageName);
            $post->thumbnail = $imageName;
            $post->save();
            $post->category()->sync($request->category_id, false);

            return response()->json([
                'data' => [
                    'post' => $post,
                    'success' => true,
                    'to' => 'artikel/' . $post->id . '/s-' . $post->slug,
                    'message' => 'Artikel Oprettet',
                ]
            ]);
        } else {
            return response()->json([
                'data' => [
                    'success' => false,
                    'errors' => $validate,
                ]
            ]);
        }
    }

    public function show($id, $slug) {
        $post = Post::find($id);
        $postWithSlug = Post::where('slug', $slug)->first();

        if ($post) {
            return view('blog.view')->withPost($post);
        } else if ($postWithSlug) {
            return view('blog.view')->withPost($postWithSlug); //if ID is entered wrong
        } else {
            Session::flash('message', 'Artiklen findes desværre ikke.');
            return redirect()->back();
        }
    }

    public function edit()
    { }

    public function update()
    { }

    public function delete()
    { }
}
