<?php

namespace App\Http\Controllers;

use App\TopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TopCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function store(Request $request) {
        $this->validate($request, array('title_dk' => 'required|max:255'));
        $tag = new TopCategory;
        $tag->title_dk = $request->title_dk;
        $tag->desc_dk = $request->desc_dk;
        $tag->title_en = 'no content';
        $tag->desc_en = 'no content';
        if (!$request->has('is_private')) {
            $tag->is_private = 0;
        } else {
            $tag->is_private = 1;
        }
        $tag->save();

        Session::flash('message', 'Katogori er oprettet!');
        return redirect()->back();
    }

    public function edit($id) {
        $topCategory = TopCategory::find($id);

        return view('blog.categories.editTop')->withCategory($topCategory);
    }

    public function update(Request $request, $id) {
        $this->validate($request, array('title_dk' => 'required|max:255'));
        $tag = TopCategory::find($id);
        $tag->title_dk = $request->title_dk;
        $tag->desc_dk = $request->desc_dk;
        $tag->title_en = 'no content';
        $tag->desc_en = 'no content';
        if (!$request->has('is_private')) {
            $tag->is_private = 0;
        } else {
            $tag->is_private = 1;
        }
        $tag->save();

        Session::flash('message', 'Katogori er gemt!');
        return redirect()->back();
    }

    public function destroy(Request $request){
        $tag = TopCategory::find($request->identification);
        $tag->category()->delete();
        $tag->delete();

        Session::flash('success', 'Katogori er slettet');
        return redirect()->back();
    }
}
