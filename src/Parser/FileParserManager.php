<?php

namespace App\Parser;

class FileParserManager
{
    public function __construct(
        private readonly JsonInvoiceParser $jsonParser,
        private readonly CsvInvoiceParser  $csvParser
    ) {}

    public function createParser(string $filepath): array
    {
        $mimeType = mime_content_type($filepath);

        return match ($mimeType) {
            'application/json' => $this->jsonParser->parse($filepath),
            'text/csv', 'text/plain', 'application/vnd.ms-excel' => $this->csvParser->parseCsv($filepath),
            default => throw new \RuntimeException("Unsupported file type: $mimeType"),
        };
    }
}
