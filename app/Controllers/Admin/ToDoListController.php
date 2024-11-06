<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ToDoListController extends BaseController
{
    public function index(): string
    {
        return view('index');
    }

    public function adminCheck($call1 = 'person1', $call2='person2'){

        echo "<h1>HAKDOG " . $call1 . "| ".$call2 . "</h1>";
        //return view('to-do-create');
    }

}
