<?php

namespace Tests\Unit\UseCases;

use App\UseCases\CalculateTotalAmountUseCase;
use Tests\TestCase;

class CalculateTotalAmountUseCaseTest extends TestCase
{ 
    // ✅
    public function testCalculateTotalWhenQuantityProductsIsGreaterThanTen(): void
    {
        // Dado
        $elevenProducts = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];

        // Cuando
        $calculateTotalAmountUseCase = new CalculateTotalAmountUseCase();
        $totalAmount = $calculateTotalAmountUseCase->execute($elevenProducts);

        // Debería
        $this->assertSame(66, $totalAmount);
    }

    // ✅
    public function testCalculateTotalWhenQuantityProductsIsGreaterLessTen(): void
    {
        // Dado
        $nineProducts = [1, 2, 3, 4, 5, 6, 7, 8, 9];

        // Cuando
        $calculateTotalAmountUseCase = new CalculateTotalAmountUseCase();
        $totalAmount = $calculateTotalAmountUseCase->execute($nineProducts);

        // Debería
        $this->assertSame(1045, $totalAmount);
    }

    // ✅
    public function testCalculateTotalWhenQuantityProductsIsGreaterLessSix(): void
    {
        // Dado
        $fiveProducts = [1, 2, 3, 4, 5];

        // Cuando
        $calculateTotalAmountUseCase = new CalculateTotalAmountUseCase();
        $totalAmount = $calculateTotalAmountUseCase->execute($fiveProducts);

        // Debería
        $this->assertSame(2015, $totalAmount);
    }

    // ✅
    public function testCalculateTotalWhenQuantityProductsIsGreaterLessFour(): void
    {
        // Dado
        $threeProducts = [1, 2, 3];

        // Cuando
        $calculateTotalAmountUseCase = new CalculateTotalAmountUseCase();
        $totalAmount = $calculateTotalAmountUseCase->execute($threeProducts);

        // Debería
        $this->assertSame(4006, $totalAmount);
    }
}
