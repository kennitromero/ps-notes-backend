<?php

namespace Tests\Unit\UseCases;

use App\UseCases\UtilUseCase;
use Tests\TestCase;

class UtilUseCaseTest extends TestCase
{
    public function testAgeLegalWhenAgeIsEqualsTo18Success(): void
    {
        // Dado un contexto
        $age = 18;

        // Cuando se ejecuta XX
        $utilUseCase = new UtilUseCase();
        $result = $utilUseCase->isUserOfLegalAge($age);

        // Debería ser YY
        $this->assertSame(true, $result);
        $this->assertTrue($result);
    }

    public function testAgeLegalWhenAgeIsMinorTo18Fail(): void
    {
        // Dado un contexto
        $age = 17;

        // Cuando se ejecuta XX
        $utilUseCase = new UtilUseCase();
        $result = $utilUseCase->isUserOfLegalAge($age);

        // Debería ser YY
        $this->assertSame(false, $result);
        $this->assertFalse($result);
    }
}
