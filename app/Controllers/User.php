<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index(): string
    {
        return view('index');
    }

    public function create(){

       // echo "<h1>HAKDOG</h1>" . $type;
        return view('to-do-create');
    }

}
