<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class FileController
{
    public function index(): View
    {
        return View::make('file/index', ['foo' => 'bar']);
    }

    public function download()
    {
        header('Content-Type: plain/text');
        header('Content-Disposition: attachment;filename="file.txt"');
        readfile(STORAGE_PATH . '/file.txt');
    }

    public function upload()
    {
        $filePath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];

        move_uploaded_file($_FILES['receipt']['tmp_name'], $filePath);

        header('Location: /');
        exit;
    }
}