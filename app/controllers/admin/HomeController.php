<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
class HomeController extends BaseController
{
    public function index()
    {
        $title = "Trang chủ";
        return $this->render('layout.main', compact('title'));
    }
}
