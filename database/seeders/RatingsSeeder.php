<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Voters;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Faker with Indonesian locale
        $faker = Faker::create('id_ID');
         // Ratings (Penilaian)
        echo "Membuat 500.000 rating...\n";
        $batchSizeRating = 5000;
        $authorIds = Author::pluck('id');
        $bookIds = Book::pluck('id');
        $voterIds = Voters::pluck('id');
        $ratings = [];
        for ($bookId = 1; $bookId <= 100000; $bookId++) {
            $numRatings = rand(0, 10);      // random rating count per book

            for ($j = 0; $j < $numRatings; $j++) {
                $ratings[] = [
                    'author_id'  => $authorIds->random(),
                    'book_id'    => $bookIds->random(),
                    'voter_id'   => $voterIds->random(),    // assign random voter
                    'rating'     => rand(1, 10),
                    'created_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                    'updated_at' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s')
                ];
                if (count($ratings) === $batchSizeRating) {
                    DB::table('ratings')->insert($ratings);
                    $ratings = [];
                }
            }
        }
        if (!empty($ratings)) DB::table('ratings')->insert($ratings);

        echo "✅ Seeder selesai.\n";
    }
}
