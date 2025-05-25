<?php

namespace App\Parser;

use App\Entity\Invoice;
use Symfony\Component\Serializer\SerializerInterface;

class CsvInvoiceParser
{
    public function __construct(
    ) {
    }

    public function parseCsv(string $fp): array
    {
        $invoices = [];
        $rows = array_map(fn($line) => str_getcsv($line, "\t"), file($fp));
        foreach ($rows as $row) {
            if (count($row) < 3) continue;
            $date = new \DateTime($row[3]);
            $row[3] = $date->format('Y-m-d');
            $invoice = (Invoice::create((float) $row[0], $row[1], $row[2], $date));
            $invoices[] = $invoice;
        }
        return $invoices;
    }
}
