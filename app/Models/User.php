<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = ['id'];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function actor()
    {
        return $this->belongsTo(Actor::class);
    }

    public function forums()
    {
        return $this->hasMany(Forum::class);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function monitors()
    {
        return $this->hasMany(Monitor::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function analysis()
    {
        return $this->hasMany(Analysis::class);
    }
}
