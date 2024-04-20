<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_date',
        'reservation_time',
        'number',
        'user_id',
        'restaurant_id',
    ];

    protected $guarded = ['id'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}





}
