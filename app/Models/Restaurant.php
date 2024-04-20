<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Restaurant extends Model
{
    protected $fillable = ['name','area','outline'];
    use HasFactory;
    public function genres(){
        return $this->belongsTo(Genre::class);
        }

        public function users()
        {
            return $this->belongsTo(User::class, 'favorite_restaurants');
        }
    

        public function scopeGenreSearch($query, $genre_id)
        {
          if (!empty($genre_id)) {
            $query->where('genre_id', $genre_id);
          }
        }

        public function scopeAreaSearch($query, $area)
        {
            if (!empty($area)) {
                $query->where('area', 'LIKE', "%{$area}%");
            }
        }

public function isFavorited()
{
    // Check if the current user has favorited this restaurant
    return $this->favoriteRestaurants()->where('user_id', auth()->id())->exists();
}
public function favoriteRestaurants()
{
    // Define the relationship between Restaurant and FavoriteRestaurant models
    return $this->hasMany(FavoriteRestaurant::class);
}  

public function isFavoritedByUser($user_id) {
  return $this->favoriteRestaurants()->where('user_id', $user_id)->exists();
}
}
