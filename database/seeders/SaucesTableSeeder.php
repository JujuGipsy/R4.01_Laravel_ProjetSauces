<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sauce;

class SaucesTableSeeder extends Seeder
{
    public function run()
    {
        Sauce::create([
            'userId' => 1, // Remplace avec un user_id valide
            'name' => 'Sauce KIPIK',
            'manufacturer' => "Feli'Peppers",
            'description' => 'Es une sauce faite con uno pimento qui pique muy bien ! Ayé !',
            'mainPepper' => 'piment oiseau',
            'imageUrl' => 'https://www.academiedugout.fr/images/7528/1200-auto/piment-oiseau-copy.jpg?poix=50&poiy=50',
            'heat' => 10,
            'likes' => 1,
            'dislikes' => 0,
            'usersLiked' => json_encode([]), // Tableau vide en JSON 
            'usersDisliked' => json_encode([]), // Tableau vide en JSON
        ]);
    }
}
