<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Auth\Authenticatable as AuthenticatableContract;


class Manager extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    protected $fillable = [
        'name', 
        'email',
        'password',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'restaurant_id', 'restaurant_id');
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, Reservation::class, 'restaurant_id', 'id', 'restaurant_id', 'user_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public static $model = Manager::class;

    /**
     * Get the displayable label of the resource.
     *
     * @param  mixed  $resource
     * @return string
     */
    public static function label()
    {
        return __('Managers');
    }
}
