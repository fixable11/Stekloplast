<?php

declare(strict_types=1);

namespace App\Models\Traits;


use DomainException;
use Illuminate\Support\Facades\Log;

trait CyclomaticTrait
{
    protected static $depthSize = 15;
    protected static $depth = 0;
    protected function guardCyclomatic()
    {
        self::$depth += 1;
        if (self::$depth >= self::$depthSize) {
            Log::error('Cyclomatic relation ' . $this);
            throw new DomainException('Cyclomatic relation.');
        }
    }
}
