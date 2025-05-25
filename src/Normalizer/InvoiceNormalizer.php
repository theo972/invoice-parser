<?php

namespace App\Normalizer;

use App\Entity\Invoice;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class InvoiceNormalizer implements DenormalizerInterface
{
    public function __construct(
        #[Autowire(service: 'serializer.normalizer.object')]
        private NormalizerInterface $normalizer,
    ) {
    }
    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === Invoice::class;
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): Invoice
    {
        if (isset($data['nom'])) {
            $data['name'] = $data['nom'];
        }
        if (isset($data['montant'])) {
            $data['amount'] = $data['montant'];
        }
        if (isset($data['devise'])) {
            $data['currency'] = $data['devise'];
        }
        if (isset($data['date']) && $data['date'] instanceof \DateTimeInterface) {
            $data['date'] = $data['date']->format('Y-m-d');
        }
        return $this->normalizer->denormalize($data, $type, $format, $context);
    }
}

