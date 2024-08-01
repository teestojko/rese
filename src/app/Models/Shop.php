<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites', 'shop_id', 'user_id')->withTimestamps();
    }

    public function isFavorited()
    {
        return $this->favoritedByUsers()->where('user_id', auth()->id())->exists();
    }

     public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

        public function shopRepresentative()
    {
        return $this->hasOne(ShopRepresentative::class);
    }
}
