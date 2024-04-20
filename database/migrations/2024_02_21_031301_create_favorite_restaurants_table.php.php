<?php

// create_favorite_restaurants_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoriteRestaurantsTable extends Migration
{
    public function up()
    {
        Schema::create('favorite_restaurants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('restaurant_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->unique(['user_id', 'restaurant_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorite_restaurants');
    }
}
