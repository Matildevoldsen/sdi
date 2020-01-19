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
        $posts = Post::all()->where('is_private', '=', '0');
        return view('blog.index')->withPosts($posts);
    }

    public function create()
    {
        if (!Auth::guest() && Auth::user()->is_admin == 1) {
            $categories = Category::all();
            return view('blog.index')->withCategories($categories);
        } else {
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        // validate the data
        $validate = $this->validate($request, array(
            'title_dk' => 'required|max:255',
            'slug' => 'required|alpha_dash|min:3|max:255|unique:posts,slug',
            'category_id' => 'required|integer',
            'content_dk' => 'required|min:50'
        ));

        if ($validate) {
            // store in the database
            $post = new Post;
            $post->title_dk = $request->title_dk;
            $post->slug = $request->slug;
            $post->category_id = $request->category_id;
            $post->meta_title_dk = $request->title_dk;
            $post->meta_desc_dk = $request->meta_desc_dk;
            if ($request->has('is_private')) {
                $post->is_private = 0;
            } else {
                $post->is_private = 1;
            }
            $image = $request->file('thumbnail');
            $filename = $image->getClientOriginalName();
            $destinationPath = 'public/thumbnail/post';

            $post->content_dk = html_entity_decode($request->content_dk);

            if ($image->storeAs("$destinationPath", $filename)) {
                $post->thumbnail = basename('post/' . $filename);
            } else {
                return response()->json([
                    'data' => [
                        'success' => false,
                        'errors' => 'En fejl skete med upload af billede',
                    ]
                ]);
            }

            $post->save();
            $post->category()->sync($request->category_id, false);

            return response()->json([
                'data' => [
                    'post' => $post,
                    'success' => true,
                    'to' => $post->id . '/s-' . $post->slug,
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

    public function show($id, $slug)
    {
        $post = Post::find($id);
        $postWithSlug = Post::where('slug', $slug)->first();

        if ($post->is_private == 1 && Auth::guest() || !Auth::guest() && Auth::user()->is_admin == 0) {
            Session::flash('error', 'Denne artikel findes ikke.');
            return redirect()->back();
        }

        if ($post) {
            return view('blog.view')->withPost($post);
        } else if ($postWithSlug) {
            return view('blog.view')->withPost($postWithSlug); //if ID is entered wrong
        } else {
            Session::flash('error', 'Artiklen findes desværre ikke.');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        if (!Auth::guest() && Auth::user()->is_admin == 1) {
            $post = Post::find($id);
            $categories = Category::all();

            return view('blog.edit')->withArticle($post)->withCategories($categories);
        }
    }

    public function update(Request $request)
    {
        $post = Post::find($request->idNum);

        // validate the data
        if ($post->slug == $request->slug) {
            $validate = $this->validate($request, array(
                'title_dk' => 'required|max:255',
                'slug' => 'required|alpha_dash|min:3|max:255',
                'category_id' => 'required|integer',
                'content_dk' => 'required|min:50'
            ));
        } else {
            $validate = $this->validate($request, array(
                'title_dk' => 'required|max:255',
                'slug' => 'required|alpha_dash|min:3|max:255|unique:posts,slug',
                'category_id' => 'required|integer',
                'content_dk' => 'required|min:50'
            ));
        }

        if ($validate && $post) {
            // store in the database
            $post->title_dk = $request->title_dk;
            $post->slug = $request->slug;
            $post->category_id = $request->category_id;
            $post->meta_title_dk = $request->title_dk;
            $post->meta_desc_dk = $request->meta_desc_dk;
            $post->content_dk = html_entity_decode($request->content_dk);
            if ($request->has('is_private')) {
                $post->is_private = 0;
            } else {
                $post->is_private = 1;
            }

            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $filename = $image->getClientOriginalName();
                $destinationPath = 'public/thumbnail/post';

                if ($image->storeAs("$destinationPath", $filename)) {
                    $post->thumbnail = basename('post/' . $filename);
                } else {
                    return response()->json([
                        'data' => [
                            'success' => false,
                            'errors' => 'Cannot upload picture',
                        ]
                    ]);
                }
            }

            $post->save();
            $post->category()->sync($request->category_id, false);

            return response()->json([
                'data' => [
                    'post' => $post,
                    'success' => true,
                    'to' => $post->id . '/s-' . $post->slug,
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

    public function delete($id)
    {
        $post = Post::find($id);
        $post->category()->detach();
        $post->category()->detach();
        $post->delete();
        Session::flash('message', 'Artiklen er slettet.');
        return redirect()->route('home');
    }
}
