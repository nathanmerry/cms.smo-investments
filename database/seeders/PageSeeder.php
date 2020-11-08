<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert(
            [
                'name' => "Scams",
                'slug' => 'scams',
                'content' => 'Scams content',
            ]
        );

        DB::table('pages')->insert(
            [
                'name' => 'How It Works',
                'slug' => 'how-it-works',
                'content' => 'How it works content',
            ]
        );

        DB::table('pages')->insert(
            [
                'name' => "FAQ's",
                'slug' => 'faq',
                'content' => 'FAQs content',
            ]
        );
    }
}
