<?php

declare(strict_types = 1);
require_once __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/eloquent.php';

$invoice = new \App\Models\Invoice();

$invoice->amount = 45;
$invoice->invoice_number = '1';
$invoice->status = \App\Enums\InvoiceStatus::Pending;
$invoice->due_date = (new \Carbon\Carbon())->addDays(18);

$invoice->save();

$items = [['Item1', 1, 15], ['Item1', 2, 1.5], ['Item1', 3, 45],];

foreach($items as [$description, $quantity, $unitPrice]) {
    $item = new \App\Models\InvoiceItem();

    $item->description = $description;
    $item->quantity = $quantity;
    $item->unit_price = $unitPrice;

    $item->invoice()->associate($invoice);

    $item->save();
    
}