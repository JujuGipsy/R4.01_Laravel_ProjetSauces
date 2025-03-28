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
            'imageUrl' => 'https://www.asiamarche.fr/cdn/shop/files/Asiamarche_-_Images_Produits_-_2025-01-10T173024.344_460x@2x.jpg?v=1736526662',
            'heat' => 10,
            'likes' => 1,
            'dislikes' => 0,
            'usersLiked' => json_encode([]), // Tableau vide en JSON 
            'usersDisliked' => json_encode([]), // Tableau vide en JSON
        ]);
    }
}
