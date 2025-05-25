<?php

declare(strict_types=1);


use App\Parser\FileParserManager;
use App\Service\InvoiceService;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class InvoiceParserTest extends KernelTestCase
{
    private $entityManager;
    private readonly FileParserManager $fileParserManager;

    public function testParseJson(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->fileParserManager = $this->createMock(FileParserManager::class);

        $connection = $this->createMock(Connection::class);
        $this->entityManager->method('getConnection')->willReturn($connection);
        $connection->expects($this->exactly(10))->method('persist');

        $invoiceParser = new InvoiceService($this->entityManager, $this->fileParserManager);
        $invoiceParser->parse('data/invoices.json');
    }

    public function testParseCsv(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->fileParserManager = $this->createMock(FileParserManager::class);

        $connection = $this->createMock(Connection::class);
        $this->entityManager->method('getConnection')->willReturn($connection);
        $connection->expects($this->exactly(10))->method('persist');

        $invoiceParser = new InvoiceService($this->entityManager, $this->fileParserManager);
        $invoiceParser->parse('data/invoices.csv');
    }

}

