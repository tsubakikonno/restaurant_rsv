<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manager;
use Illuminate\Support\Facades\Hash;

class ManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manager::create([
            'name' => '仙人',
            'email' => 'sennin@example.com',
            'password' => Hash::make('hashed_password_here'),
            'restaurant_id' => 1,
        ]);
        
        // 牛助
        Manager::create([
            'name' => '牛助',
            'email' => 'gyusuke@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 2,
        ]);
        
        // 戦慄
        Manager::create([
            'name' => '戦慄',
            'email' => 'senritsu@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 3,
        ]);
        
        // ルーク
        Manager::create([
            'name' => 'ルーク',
            'email' => 'luke@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 4,
        ]);
        
        // 志摩屋
        Manager::create([
            'name' => '志摩屋',
            'email' => 'shimaya@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 5,
        ]);
        
        // 香
        Manager::create([
            'name' => '香',
            'email' => 'kou@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 6,
        ]);
        
        // JJ
        Manager::create([
            'name' => 'JJ',
            'email' => 'UU@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 7,
        ]);
        
        // らーめん極み
        Manager::create([
            'name' => 'らーめん極み',
            'email' => 'ramenkiwami@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 8,
        ]);
        
        // 鳥雨
        Manager::create([
            'name' => '鳥雨',
            'email' => 'amadori@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 9,
        ]);
        
        // 築地色合
        Manager::create([
            'name' => '築地色合',
            'email' => 'tukijiiroai@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 10,
        ]);
        
        // 晴海
        Manager::create([
            'name' => '晴海',
            'email' => 'harumi@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 11,
        ]);
        
        // 三子
        Manager::create([
            'name' => '三子',
            'email' => 'sanshi@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 12,
        ]);
        
        // 八戒
        Manager::create([
            'name' => '八戒',
            'email' => 'hakkai@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 13,
        ]);
        
        // 福助
        Manager::create([
            'name' => '福助',
            'email' => 'fukusuke@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 14,
        ]);
        
        // ラー北
        Manager::create([
            'name' => 'ラー北',
            'email' => 'ra-kita@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 15,
        ]);
        
        // 翔
        Manager::create([
            'name' => '翔',
            'email' => 'sho@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 16,
        ]);
        
        // 経緯
        Manager::create([
            'name' => '経緯',
            'email' => 'keii@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 17,
        ]);
        
        // 漆
        Manager::create([
            'name' => '漆',
            'email' => 'urushi@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 18,
        ]);
        
        // THE TOOL
        Manager::create([
            'name' => 'THE TOOL',
            'email' => 'thetool@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 19,
        ]);
        
        // 木船
        Manager::create([
            'name' => '木船',
            'email' => 'kifune@example.com',
            'password' => Hash::make('restaurant12345'),
            'restaurant_id' => 20,
        ]);
    }
}
