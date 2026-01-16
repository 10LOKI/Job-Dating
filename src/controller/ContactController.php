<?php
namespace App\controller;

use App\core\BaseController;

class ContactController extends BaseController
{
    public function index()
    {
        $this->view('contact', ['title' => 'Contact Page']);
    }
}
