<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Portfolio extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    public $timestamps = false;
    protected $table = 'portfolio';
    protected $guarded = ['id'];
    protected $attributes = [
        'coordinates' => '{}',
    ];
    protected $casts = [
        'photos' => 'array'
    ];


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
     * @param $value
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
