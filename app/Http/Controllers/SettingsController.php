<?php

namespace App\Http\Controllers;

use App\Post;
use App\Setting;
use Cassandra\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function edit()
    {
//        $settingd = new Setting;
//
//        $settingd->welcome_dk = 'Velkommen';
//        $settingd->main_site_desc = 'Velkommen';
//        $settingd->welcome_en ='Velkommen';
//        $settingd->thumbnail ='/dikd';
//        $settingd->save();
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

        if (isset($request->thumbnail) && $request->thumbnail && $path = Storage::disk('public')->put('thumbnail/'. $request->file('thumbnail')->getClientOriginalName(), $request->file('thumbnail'))) {
            $setting->thumbnail = basename($path);
        }

        $setting->save();

        return redirect()->route('home');
    }
}
