<?php

namespace App\Controllers;

use App\Controllers\Admin\ToDoListController as YEAH;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
