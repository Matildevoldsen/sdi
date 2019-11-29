<?php

namespace App\Http\Controllers;

use App\Post;
use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function edit()
    {
        $setting = Setting::find(1);

        if ($setting) {
            return view('settings.index')->withSetting($setting);
        }

        return view('settings.index');
    }

    public function update(Request $request)
    {
        $setting = Setting::find(1);
        $setting->welcome_dk = $request->welcome_dk;
        $setting->welcome_en = $request->welcome_en;
        $setting->main_site_desc = $request->main_site_desc;

        if ($path = $request->file('thumbnail')->store('public/thumbnail')) {
            $setting->thumbnail = basename($path);
        }

        $setting->save();

        return redirect()->route('home');
    }
}
