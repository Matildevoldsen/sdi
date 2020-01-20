<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function get(Request $request) {
        $q = $request->q;
        $posts = Post::where('title_dk','LIKE','%'.$q.'%')
            ->orWhere('content_dk','LIKE','%'.$q.'%')->
            orWhere('slug', 'LIKE', '%'. $q .'%')->
            orWhere('meta_desc_dk', 'LIKE', '%'. $q .'%')->get();;
        $SearchCategories = Category::where('title_dk','LIKE','%'.$q.'%')
            ->orWhere('desc_dk','LIKE','%'.$q.'%')->get();;

        return view('search.index')->withPosts($posts)->withSearchCategories($SearchCategories)->withQuery($q);
    }
}
