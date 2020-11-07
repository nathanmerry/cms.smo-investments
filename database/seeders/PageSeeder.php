<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::updateOrCreate([
            'name' => "Scams",
            'slug' => 'scams',
            'content' => 'Scams content',
        ]);

        Page::updateOrCreate([
            'name' => 'How It Works',
            'slug' => 'how-it-works',
            'content' => 'How it works content',
        ]);
        Page::updateOrCreate([
            'name' => "FAQ's",
            'slug' => 'faq',
            'content' => 'FAQs content',
        ]);
    }
}
