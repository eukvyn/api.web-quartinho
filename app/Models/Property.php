<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'rental_price',
        'address',
        'user_id',
        'amenities',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }

    public function getRatingsAverageAttribute()
    {
        return $this->comments()->avg('rating') ?? 0;
    }

    public function getAmenitiesAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setAmenitiesAttribute($value)
    {
        $this->attributes['amenities'] = json_encode($value);
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }
}
