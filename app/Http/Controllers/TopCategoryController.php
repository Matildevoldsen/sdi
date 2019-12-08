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
        $tag->save();

        Session::flash('message', 'Katogori er gemt!');
        return redirect()->back();
    }

    public function delete() {

    }
}
