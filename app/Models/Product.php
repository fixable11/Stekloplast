<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    public $timestamps = false;
    protected $fakeColumns = ['attributes'];
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $attributes = [
        'attributes' => '{}',
    ];
    protected $casts = [
        'attributes' => 'array',
        'photos' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj) {
            if (count((array) $obj->photos)) {
                foreach ($obj->photos as $file_path) {
                    Storage::disk('public')->delete($file_path);
                }
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
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
     * @param $value
     */
    public function setPhotosAttribute($value)
    {
        $this->uploadMultipleFilesToDisk(
            $value,
            "photos",
            config('app.disk'),
            config('app.products_photo_path')
        );
    }
}
