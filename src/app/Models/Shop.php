<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = [
        'id', 'user_id',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorites', 'shop_id', 'user_id')
                    ->withTimestamps();
    }

    public function isFavorited()
    {
        return $this->favoritedByUsers()->where('user_id', auth()->id())->exists();
    }
}
