<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('blog.categories.index')->withCategory($categories);
    }

    public function store(Request $request)
    {
        $this->validate($request, array('title_dk' => 'required|max:255'));
        $tag = new Category;
        $tag->title_dk = $request->title_dk;
        $tag->desc_dk = $request->desc_dk;
        $tag->title_en = 'no content';
        $tag->desc_en = 'no content';
        $tag->save();

        Session::flash('success', 'Katogori er oprettet!');
        return redirect()->route('blog.categories.index', $tag->id);
    }

    public function view($id)
    {
        $category = Category::find($id);

        return view('blog.categories.view')->withCategory($category);
    }

    public function edit($id)
    {
        $tag = Category::find($id);
        return view('tags.edit')->withTag($tag);
    }

    public function update(Request $request, $id)
    {
        $tag = Category::find($id);
        $this->validate($request, ['name' => 'required|max:255']);
        $tag->title_dk = $request->title_dk;
        $tag->title_en = $request->title_en;
        $tag->desc_dk = $request->desc_dk;
        $tag->desc_en = $request->desc_en;
        $tag->save();
        Session::flash('success', 'Successfully saved your new tag!');
        return redirect()->route('blog.categories.view', $tag->id);
    }

    public function destroy(Request $request)
    {
        $tag = Category::find($request->identification);

        if ($tag) {
            $tag->posts()->detach();
            $tag->delete();
            Session::flash('success', 'Katogori er slettet');
            return redirect()->route('category.showForm');
        } else {
            Session::flash('success', 'Katogori findes ikke');
            return redirect()->route('category.showForm');
        }
    }
}
