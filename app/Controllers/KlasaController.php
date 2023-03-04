<?php

declare(strict_types=1);

namespace App\Controllers;

class KlasaController
{
    public function index(): string
    {
        return 'To jest index z Klasa';
    }

    public function create(): string
    {
        return '<form action="/klasa/create" method="post"><input type="text" name="amount"><submit></submit></form>';
    }

    public function store()
    {
        $amount = $_POST['amount'];

        var_dump($amount);
    }
}