<?php

declare(strict_types=1);

namespace App\Models\Traits;


use DomainException;
use Illuminate\Support\Facades\Log;

trait CyclomaticTrait
{
    protected static $ids = [];

    protected function guardCyclomatic()
    {
        if (in_array($this->id, self::$ids)) {
            Log::error('Cyclomatic relation ' . $this);
            throw new DomainException('Cyclomatic relation.');
        }
        self::$ids[] = $this->id;
    }
}
