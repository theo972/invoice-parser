<?php

namespace App\Parser;

use App\Entity\Invoice;
use Symfony\Component\Serializer\SerializerInterface;

readonly class JsonInvoiceParser
{
    public function __construct(private SerializerInterface $serializer) {
    }

    public function parse(string $filepath): array
    {
        $content = file_get_contents($filepath);
        return $this->serializer->deserialize($content, Invoice::class . '[]', 'json');
    }
}
