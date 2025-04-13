<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return 'hello</br>'.'<a href="'.route('logout').'">Logout</a>';
    }
}
