<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\FavoriteRestaurant;
use Illuminate\Support\Facades\Auth;

class FavoriteRestaurantController extends Controller
{
    
    public function storerestau(Request $request)
    {
        $favrestau = new FavoriteRestaurant;
        $favrestau->restaurant_id = $request->restaurant_id;
        $favrestau->user_id = Auth::user()->id;
        $favrestau->save();
        
        return redirect('/');
    }
    
    public function destroy(Request $request) {

            $favoriteRestaurant = FavoriteRestaurant::find($request->id);
            if ($favoriteRestaurant) {
                $favoriteRestaurant->delete();
            }
            return redirect('/');
        }
    
        
    
    

}