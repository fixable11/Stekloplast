<?php

declare(strict_types=1);

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * Class Product.
 * @method static findOrFail(int $id)
 */
class Product extends Model
{
    use CrudTrait;
    use HasTranslations;

    /**
     * @var boolean $timestamps Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * @var boolean $timestamps Indicates if the model should be timestamped.
     */
    //protected $fakeColumns = ['attributes', 'name'];

    /**
     * @var string $table The table associated with the model.
     */
    protected $table = 'products';

    /**
     * @var string $primaryKey The primary key for the model.
     */
    protected $primaryKey = 'id';

    /**
     * @var array $guarded The attributes that aren't mass assignable.
     */
    protected $guarded = ['id'];

    /**
     * @var array $attributes The model's attributes.
     */
    protected $attributes = [
        'attributes' => '{}',
    ];

    protected $translatable = ['name', 'attributes'];

    /**
     * @var array $casts The attributes that should be cast to native types.
     */
    protected $casts = [
        'attributes' => 'array',
        'photos' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();
        static::deleting(function ($obj) {
            if (count((array) $obj->photos)) {
                foreach ($obj->photos as $filePath) {
                    Storage::disk('public')->delete($filePath);
                }
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Get products category.
     *
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
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

    /**
     * Set photos mutator.
     *
     * @param mixed $value Array of photos to upload.
     *
     * @return void
     */
    public function setPhotosAttribute($value): void
    {
        $this->uploadMultipleFilesToDisk(
            $value,
            "photos",
            config('app.disk'),
            config('app.products_photo_path')
        );
    }
}
