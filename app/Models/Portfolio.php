<?php

declare(strict_types=1);

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class Portfolio model.
 */
class Portfolio extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    /**
     * @var boolean $timestamps Disable or enable timestamps.
     */
    public $timestamps = false;

    /**
     * @var string $table Table name.
     */
    protected $table = 'portfolio';

    /**
     * @var array $guarded The attributes that aren't mass assignable.
     */
    protected $guarded = ['id'];

    /**
     * The model's attributes.
     *
     * @var array $attributes Attributes.
     */
    protected $attributes = [
        'coordinates' => '{}',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array $casts Casts.
     */
    protected $casts = [
        'photos' => 'array'
    ];

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

    /**
     * Set photo mutator.
     *
     * @param mixed $value Array of photos.
     *
     * @return void
     */
    public function setPhotosAttribute($value)
    {
        $this->uploadMultipleFilesToDisk(
            $value,
            "photos",
            config('app.disk'),
            config('app.portfolio_photo_path')
        );
    }
}
