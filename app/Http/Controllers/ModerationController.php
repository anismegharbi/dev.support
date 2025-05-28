<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModerationController extends Controller
{
    public function index()
    {
        return view('forum.index'); 
    }
}
