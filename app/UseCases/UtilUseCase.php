<?php

namespace App\UseCases;

class UtilUseCase
{
    public function isUserOfLegalAge(int $age): bool
    {
        if ($age >= 18) {
            return true;
        }

        return false;
    }
}
