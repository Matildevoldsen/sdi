<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\TopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        if (!Auth::guest() && Auth::user()->is_admin == 1) {
            $categories = Category::all();
            $topCategories = TopCategory::all();

            return view('blog.categories.index')->withCategories($categories)->withTopCategory($topCategories);
        } else {
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, array('title_dk' => 'required|max:255'));
        $tag = new Category;
        $tag->title_dk = $request->title_dk;
        $tag->desc_dk = html_entity_decode($request->desc_dk);
        $tag->top_category_id = $request->top_category_id;
        $tag->title_en = 'no content';
        $tag->desc_en = 'no content';
        if ($request->has('is_private')) {
            $tag->is_private = 0;
        } else {
            $tag->is_private = 1;
        }

        $image = $request->file('thumbnail');
        $filename = $image->getClientOriginalName();
        $destinationPath = 'public/thumbnail/category';

        if ($image->storeAs("$destinationPath", $filename)) {
            $tag->thumbnail = basename($filename);
        } else {
            return response()->json([
                'data' => [
                    'post' => $tag,
                    'success' => false,
                    'to' => $tag->id,
                    'message' => 'Kan ikke uploade billede',
                ]
            ]);
        }
        $tag->save();

        return response()->json([
            'data' => [
                'post' => $tag,
                'success' => true,
                'to' => $tag->id,
                'message' => 'Katogori Oprettet',
            ]
        ]);
    }

    public function view($id)
    {
        $category = Category::find($id);
        $posts = Post::all()->where('category_id', $id);

        if ($category->is_private == 1) {
            if (!Auth::guest() && Auth::user()->is_admin == 1) {
                return view('blog.categories.view')->withCategory($category)->withPosts($posts);
            }
            Session::flash('error', 'Denne katogori findes ikke.');
            return redirect()->back();
        }

        return view('blog.categories.view')->withCategory($category)->withPosts($posts);
    }

    public function edit($id)
    {
        if (!Auth::guest() && Auth::user()->is_admin == 1) {
            $tag = Category::find($id);
            $topCategory = TopCategory::all();
            return view('blog.categories.edit')->withCategory($tag)->withTopCategories($topCategory);
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request)
    {
        $tag = Category::find($request->id);
        $tag->title_dk = $request->title_dk;
        $tag->title_en = 'null';
        $tag->desc_dk = html_entity_decode($request->desc_dk);
        $tag->top_category_id = $request->top_category_id;
        $tag->desc_en = 'null';
        if ($request->has('is_private')) {
            $tag->is_private = 0;
        } else {
            $tag->is_private = 1;
        }

        $image = $request->file('thumbnail');
        $destinationPath = 'public/thumbnail/category';


        if ($request->hasFile('thumbnail') &&  $filename = $image->getClientOriginalName()) {
            $image->storeAs("$destinationPath", $filename);
            $tag->thumbnail = basename($filename);
        }
        $tag->save();
        return response()->json([
            'data' => [
                'post' => $tag,
                'success' => true,
                'to' => $tag->id,
                'message' => 'Katogori gemt',
            ]
        ]);
    }

    public function destroy(Request $request)
    {
        $tag = Category::find($request->identification);

        if ($tag) {
            $tag->posts()->delete();

            $tag->delete();


            Session::flash('success', 'Katogori er slettet');
            return redirect()->route('category.showForm');
        } else {
            Session::flash('success', 'Katogori findes ikke');
            return redirect()->route('category.showForm');
        }
    }
}
