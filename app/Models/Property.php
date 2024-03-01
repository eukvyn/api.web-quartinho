<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'rental_price',
        'address',
        'user_id',
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }

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

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
    }
    protected $appends = ['created_at_formatted'];
}
