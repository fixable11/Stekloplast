<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\CyclomaticTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Category model.
 * @method static findOrFail(int $id)
 */
class Category extends Model
{
    use CrudTrait, CyclomaticTrait;

    /**
     * @var boolean $timestamps Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * @var string $table The table associated with the model.
     */
    protected $table = 'categories';

    /**
     * @var array $guarded The attributes that aren't mass assignable.
     */
    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Get parent category.
     *
     * @return BelongsTo
     */
    public function parent()
    {
        $this->guardCyclomatic();

        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get children category.
     *
     * @return HasMany
     */
    public function children()
    {
        $this->guardCyclomatic();

        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get product of category.
     *
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

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
