<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit() {
        $setting = Setting::find(1);

        if ($setting) {
            return view('settings.index')->withSetting($setting);
        }

        return view('settings.index');
    }

    public function update() {

    }
}
