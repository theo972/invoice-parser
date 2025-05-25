<?php

declare(strict_types=1);


namespace App\Command;

use App\Repository\InvoiceRepository;
use App\Service\InvoiceService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

// php bin/console app:parse --filename=data/invoices.csv
#[AsCommand(name: 'app:parse')]
class ParseInvoicesCommand extends Command
{
    private InvoiceService $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        parent::__construct();
        $this->invoiceService = $invoiceService;
    }

    protected function configure(): void
    {
        $this
            ->addOption('filename', 'filename', InputOption::VALUE_REQUIRED, 'Name of file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filename = (string) $input->getOption('filename');
//        $this->invoiceService->parse('data/invoices.json');
        $this->invoiceService->parse($filename);
        return Command::SUCCESS;
    }
}
