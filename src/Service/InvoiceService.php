<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Invoice;
use App\Parser\FileParserManager;
use Doctrine\ORM\EntityManagerInterface;

class InvoiceService
{
    private EntityManagerInterface $em;
    public function __construct(
        EntityManagerInterface $em,
        private readonly FileParserManager $fileParserManager
    ) {
        $this->em = $em;
    }

    public function create(Invoice $invoice): bool
    {
        $this->em->persist($invoice);
        $this->em->flush();
        return true;
    }

    public function parse(string $fp): void
    {
        /** @var Invoice[] $invoices */
        $invoices = $this->fileParserManager->createParser($fp);
        foreach ($invoices as $invoice) {
            $this->create($invoice);
        }
    }
}
