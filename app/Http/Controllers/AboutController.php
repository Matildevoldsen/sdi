<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::find(1);
        return view('about.index')->withAbout($about);
    }

    public function edit()
    {
        $about = About::find(1);

        return view('about.edit')->withAbout($about);
    }

    public function update(Request $request)
    {
        $about = About::find(1);
        $about->desc = $request['desc'];

        if ($path = $request->file('bg')->store('public/thumbnail')) {
            $about->bg = basename($path);
        }
        $about->save();

        return response()->json([
            'data' => [
                'post' => $about,
                'success' => true,
                'to' => '',
                'message' => 'Artikel Oprettet',
            ]
        ]);
    }
}
