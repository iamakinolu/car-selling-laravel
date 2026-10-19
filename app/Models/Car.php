<?php

namespace App\Models;

use App\Services\CarImageStorage;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasUuids;

    protected $fillable = ['user_id', 'maker', 'model', 'year', 'car_type', 'fuel_type', 'price', 'mileage', 'state', 'city', 'description', 'features', 'published'];

    protected function casts(): array
    {
        return ['price' => 'decimal:2', 'features' => 'array', 'published' => 'boolean'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(CarImage::class)->orderBy('position');
    }

    public function watchlistedBy()
    {
        return $this->belongsToMany(User::class, 'watchlists');
    }

    public function getPrimaryImageUrlAttribute(): string
    {
        $image = $this->images->first();

        return $image ? app(CarImageStorage::class)->url($image->path) : '/img/cars/Lexus-RX200t-2016/1.jpeg';
    }
}
