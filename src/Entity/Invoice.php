<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: 'App\Repository\InvoiceRepository')]
class Invoice
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    public int $id;

    #[ORM\Column(type: 'string', nullable: false)]
    public string $name;

    #[ORM\Column(type: 'float', nullable: false)]
    public float $amount;

    #[ORM\Column(type: 'string', nullable: false)]
    public string $currency;

    #[ORM\Column(type: 'datetime', nullable: false)]
    public DateTime $date;

    public static function create(float $amount, string $currency, string $name, DateTime $date): self
    {
        return (new Invoice())
            ->setCurrency($currency)
            ->setName($name)
            ->setAmount($amount)
            ->setDate($date);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Invoice
    {
        $this->name = $name;
        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): Invoice
    {
        $this->amount = $amount;
        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): Invoice
    {
        $this->currency = $currency;
        return $this;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function setDate(DateTime $date): Invoice
    {
        $this->date = $date;
        return $this;
    }
}
