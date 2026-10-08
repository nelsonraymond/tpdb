<?php

namespace App\Exceptions;

use RuntimeException;

class InvalidOrderStateTransitionException extends RuntimeException
{
    public function __construct(string $from, string $to)
    {
        parent::__construct("Perubahan status pesanan dari '{$from}' ke '{$to}' tidak diizinkan.");
    }
}
