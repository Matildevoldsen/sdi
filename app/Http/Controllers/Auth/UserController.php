<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function edit() {

    }

    public function update(Request $request) {

    }

    public function view($id) {
        $user = User::find($id);

        if ($user) {
            dd($user);
        } else {
            Session::flash('error', 'Brugeren findes ikke.');
            return redirect()->back();
        }
    }
}
