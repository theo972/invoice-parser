<?php

namespace App\Parser;

use App\Entity\Invoice;
use Symfony\Component\Serializer\SerializerInterface;

class JsonInvoiceParser
{
    public function __construct(private readonly SerializerInterface $serializer) {
    }

    public function parse(string $filepath): array
    {
        $content = file_get_contents($filepath);
        return $this->serializer->deserialize($content, Invoice::class . '[]', 'json');
    }
}
