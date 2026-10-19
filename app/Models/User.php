<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Authenticatable implements CanResetPasswordContract {
    use CanResetPassword;
    use HasUuids, Notifiable;
    protected $fillable = ['name','email','phone','password'];
    protected $hidden = ['password','remember_token'];
    protected function casts(): array { return ['email_verified_at'=>'datetime','password'=>'hashed']; }
    public function cars() { return $this->hasMany(Car::class); }
    public function watchlistCars() { return $this->belongsToMany(Car::class, 'watchlists'); }
    public function isAdmin(): bool {
        $adminEmail = config('services.admin_email');
        return filled($adminEmail) && strcasecmp($this->email, $adminEmail) === 0;
    }
}
