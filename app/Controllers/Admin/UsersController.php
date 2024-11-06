<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class UsersController extends BaseController
{
    public function index()
    {
        echo "HELLO, USER AREA";
    }

    public function getAllUsers(){

        echo "<h1>USERS</h1>";
        //return view('to-do-create');
    }

}
