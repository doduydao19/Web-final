<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return $this->render('category');

    }
}