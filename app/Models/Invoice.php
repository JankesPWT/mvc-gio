<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\InvoiceStatus;
use App\Model;
use PDO;

class Invoice extends Model
{

    public function all(InvoiceStatus $status): array
    {
        $stmt = $this->db->prepare(
            'SELECT id, invoice_number, amount, status
             FROM invoices
             WHERE status = ?'
        );

        $stmt->execute([$status->value]);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function create(float $amount, int $userId):int 
    {
        $stmt = $this->db->prepare(
            'INSERT INTO invoices (amount, user_id)
             VALUES (?, ?)'
        );

        $stmt->execute([$amount, $userId]);

        return (int) $this->db->lastInsertId();
    }

    public function find(int $invoiceId)//: array
    {
        $stmt = $this->db->prepare(
            'SELECT invoices.id, amount, full_name
             FROM invoices
             LEFT JOIN users ON users.id = user_id
             WHERE invoices.id = ?'
        );
        $stmt->execute([$invoiceId]);

        $invoice = $stmt->fetch();

        return $invoice ? $invoice : [];
    }
}