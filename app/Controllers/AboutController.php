<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class AboutController
{
    public function index(): View
    {
        return View::make('about/index');
    }

    public function create(): View
    {
        return View::make('about/create');
    }

    public function store()
    {
        $amount = $_POST['amount'];

        var_dump($amount);
    }
}