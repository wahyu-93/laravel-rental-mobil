<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Car extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function($model){
            $model->slug = Str::slug($model->name);
        });

        static::updating(function($model){
            $model->slug = Str::slug($model->name);
        });
    }

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/cars/' . $image),
        );
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
