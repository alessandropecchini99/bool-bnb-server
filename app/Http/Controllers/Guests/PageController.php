<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller {
    public function home() {
        if (!Auth::user()) {
            return view('auth.login');
        } else {
            return view('admin.dashboard');
        }
    }
}
