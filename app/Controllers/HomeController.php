<?php

declare(strict_types=1);

namespace App\Controllers;

use App\App;
use App\View;
use App\Models\Invoice;
use App\Models\SignUp;
use App\Models\User;

class HomeController
{
    public function index(): View
    {
        $email = 'user@mail.com';
        $name = "User Name";
        $amount = 12.5;

        $userModel = new User();
        $invoiceModel = new Invoice();

        $invoiceId = (new SignUp($userModel, $invoiceModel))->register(
            [
                'email' => $email,
                'name' => $name
            ],
            [
                'amount' => $amount,
            ]
        );

        return View::make('index', ['invoice' => $invoiceModel->find($invoiceId)]);
    }
}