<?php

declare(strict_types=1);

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Phone model.
 */
class Phone extends Model
{
    use CrudTrait;

    /**
     * @var boolean $timestamps Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * @var string $table The table associated with the model.
     */
    protected $table = 'phones';

    /**
     * @var array $guarded The attributes that aren't mass assignable.
     */
    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
