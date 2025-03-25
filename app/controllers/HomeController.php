<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $title = "Trang chủ";
        return $this->render('layout.main', compact('title'));
    }
}
