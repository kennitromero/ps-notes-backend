<?php

namespace App\UseCases;

class CalculateTotalAmountUseCase
{
    private const IVA_PERCENTAGE = 0.19;
    private int $totalWithoutIVA = 0;
    private int $totalWithIVA = 0;
    private int $iva = 0;

    public function __construct(int $subTotal, int $deliveryAmount)
    {
        $this->totalWithoutIVA = $subTotal + $deliveryAmount;
        $this->iva = $this->totalWithoutIVA * self::IVA_PERCENTAGE;
        $this->totalWithIVA = $this->totalWithoutIVA + $this->iva;
    }

    public function getTotal(): int
    {
        return $this->totalWithIVA;
    }

    public function getIVA(): int
    {
        return $this->iva;
    }
}
