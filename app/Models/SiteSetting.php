<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Accessor untuk atribut logo
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? url('/storage/logos/' . $value) : null,
        );
    }

}
