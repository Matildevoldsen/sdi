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

        if ($request->hasFile('bg')) {
            $path = $request->file('bg')->store('public/thumbnail');
            if ($path) {
                $about->bg = basename($path);
            } else {
                return response()->json([
                    'data' => [
                        'post' => $about,
                        'success' => false,
                        'to' => '',
                        'message' => 'Problemer med at gemme billede.'
                    ]
                ]);
            }
        }

        $about->save();
        return response()->json([
            'data' => [
                'post' => $about,
                'success' => true,
                'to' => '',
                'message' => 'Om mig siden opdateret',
            ]
        ]);

    }
}
