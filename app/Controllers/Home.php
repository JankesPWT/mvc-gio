<?php

declare(strict_types=1);

namespace App\Controllers;

class Home
{
    public function index(): string
    {
        return <<<FORM
        <form action="/klasa/create" method="post">
            <input type="text" name="amount">
            <input type="submit">
        </form>
        FORM;
    }

    public function create(): string
    {
        return 'a';
    }

    public function store()
    {
        $amount = $_POST['amount'];

        //var_dump($amount);
    }
}