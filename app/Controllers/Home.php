<?php

namespace App\Controllers;

class Home extends BaseController
{
    // Loading view of Homepage
    // ========================
    public function index()
    {
        return view('home');
    }
}