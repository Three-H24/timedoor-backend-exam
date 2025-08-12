<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ini_set('memory_limit', '1024M');

        // Faker with Indonesian locale
        $faker = Faker::create('id_ID');

        // Authors (Penulis)
        echo "Membuat 1000 penulis...\n";
        $batchSizeAuthor = 1000;
        $authors = [];
        for ($i = 0; $i < 1000; $i++) {
            $authors[] = [
                'author_name'   => $faker->name,
                'created_at'    => now(),
                'updated_at'    => now()
            ];

            if (count($authors) >= $batchSizeAuthor) {
                DB::table('authors')->insert($authors);
                $authors = [];
            }
        }
        if (!empty($authors)) DB::table('authors')->insert($authors);

        echo "✅ Seeder selesai.\n";
    }
}
