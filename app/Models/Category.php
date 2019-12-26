<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\CyclomaticTrait;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    protected $hidden = ['lft', 'rgt'];

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
     * Get child category.
     *
     * @return HasOne
     */
    public function child()
    {
        $this->guardCyclomatic();

        return $this->hasOne(Category::class, 'parent_id');
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

    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;

        while(!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }

    public function getChildrenAttribute()
    {
        $children = collect([]);

        $child = $this->child;

        while(!is_null($child)) {
            $children->push($child);
            $child = $child->child;
        }

        return $children;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
