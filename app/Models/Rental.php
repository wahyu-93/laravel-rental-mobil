<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function userReview()
    {
        return $this->hasOne(Review::class)->where('user_id', auth()->id());
    }

    public function payments()
    {
        return $this->hasMany(RentalPayment::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function addons()
    {
        return $this->belongsToMany(Addon::class, 'rental_addons')
            ->withPivot('quantity', 'total_price')
            ->withTimestamps();
    }

}
