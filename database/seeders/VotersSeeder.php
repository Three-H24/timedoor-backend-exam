<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class VotersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ini_set('memory_limit', '1024M');

        // Faker with Indonesian locale
        $faker = Faker::create('id_ID');
         // Voters (Yang ngevote Buku)
        echo "Membuat 50.000 voters buku...\n";
        $batchSizeVoter = 1000;
        $authorIds = Author::pluck('id');
        $bookIds = Book::pluck('id');
        $voters = [];
        for ($i = 0; $i <= 50000; $i++) {
            $voters[] = [
                'author_id'     => $authorIds->random(),
                'book_id'       => $bookIds->random(),
                'total_vote'    => rand(1, 50000),
                'created_at'    => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
                'updated_at'    => $faker->dateTimeThisYear()->format('Y-m-d H:i:s')
            ];
            if (count($voters) >= $batchSizeVoter) {
                DB::table('voters')->insert($voters);
                $voters = [];
            }
        }
        if (!empty($voters)) DB::table('voters')->insert($voters);

        echo "✅ Seeder selesai.\n";
    }
}
