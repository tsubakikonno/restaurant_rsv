<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['image_path', 'image_name','name'];
    use HasFactory;
    public function restaurants(){
        return $this->hasMany(Restaurant::class);
        }


}
