<?php
namespace App\controller;

use App\core\BaseController;

class AboutController extends BaseController
{
    public function index()
    {
        $this->view('about', ['title' => 'About Page']);
    }
}
