<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function create()
    {
        return view('todo.create');
    }

        function home()
    {
        return view("todo.homepage");
    }
}


