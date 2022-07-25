<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ratings from https://www.fifaindex.com/teams/fifa21/
        $teams = [
            [
                "name" => "Liverpool",
                "handle" => "liverpool",
                "imageUrl" => "https://resources.premierleague.com/premierleague/badges/25/t14.png",
                "attackRating" => 86,
                "midfieldRating" => 83,
                "defenceRating" => 80,
            ],
            [
                "name" => "Manchester City",
                "handle" => "manchester-city",
                "imageUrl" => "https://resources.premierleague.com/premierleague/badges/25/t43.png",
                "attackRating" => 85,
                "midfieldRating" => 86,
                "defenceRating" => 85,
            ],
            [
                "name" => "Chelsea",
                "handle" => "chelsea",
                "imageUrl" => "https://resources.premierleague.com/premierleague/badges/25/t8.png",
                "attackRating" => 82,
                "midfieldRating" => 84,
                "defenceRating" => 82,
            ],
            [
                "name" => "Arsenal",
                "handle" => "arsenal",
                "imageUrl" => "https://resources.premierleague.com/premierleague/badges/25/t3.png",
                "attackRating" => 83,
                "midfieldRating" => 79,
                "defenceRating" => 79,
            ]
        ];

        // Bulk insert teams into database
        Team::insert($teams);
    }
}
