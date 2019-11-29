<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\TopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $tag->desc_dk = $request->desc_dk;
        $tag->top_category_id = $request->top_category_id;
        $tag->title_en = 'no content';
        $tag->desc_en = 'no content';
        $tag->save();

        Session::flash('message', 'Katogori er oprettet!');
        return redirect()->back();
    }

    public function view($id)
    {
        $category = Category::find($id);
        $posts = Post::all()->where('category_id', $id);

        return view('blog.categories.view')->withCategory($category)->withPosts($posts);
    }

    public function edit($id)
    {
        if (!Auth::guest() && Auth::user()->is_admin == 1) {
            $tag = Category::find($id);
            $topCategory = TopCategory::all();
            return view('tags.edit')->withTag($tag)->withTopCategories($topCategory);
        } else {
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $tag = Category::find($id);
        $this->validate($request, ['name' => 'required|max:255']);
        $tag->title_dk = $request->title_dk;
        $tag->title_en = $request->title_en;
        $tag->desc_dk = $request->desc_dk;
        $tag->top_category_id = $request->top_category_id;
        $tag->desc_en = $request->desc_en;
        $tag->save();
        Session::flash('success', 'Successfully saved your new tag!');
        return redirect()->route('blog.categories.view', $tag->id);
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
