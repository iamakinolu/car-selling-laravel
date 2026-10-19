<?php

namespace App\Models;

use App\Services\CarImageStorage;
use Illuminate\Database\Eloquent\Model;

class CarImage extends Model
{
    protected $fillable = ['car_id', 'path', 'position'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function getUrlAttribute(): string
    {
        return app(CarImageStorage::class)->url($this->path);
    }
}
