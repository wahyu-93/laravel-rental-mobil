<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn($image) => url('/storage/payment_menthods/' . $image),
        );
    }
}
