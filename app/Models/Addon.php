<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function rentals()
    {
        return $this->belongsToMany(Rental::class, 'rental_addons')
                    ->withPivot('quantity', 'total_price')
                    ->withTimestamps();
    }

}
