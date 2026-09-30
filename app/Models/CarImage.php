<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CarImage extends Model {
    protected $fillable = ['car_id','path','position'];
    public function car() { return $this->belongsTo(Car::class); }
    public function getUrlAttribute(): string { return app(\App\Services\CarImageStorage::class)->url($this->path); }
}
