<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioPhoto extends Model
{
    protected $table = 'portfolio';
    // protected $primaryKey = 'id';
    public $timestamps = false;

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
