<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Website;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents('./websites.json'), true);
        foreach ($data as $key => $website) {
            $data[$key] = array_change_key_case($data[$key], CASE_LOWER);
            $data[$key]['website_slug'] = str_replace(' ', '-', strtolower($data[$key]['website_name']));;
            $data[$key]['company'] = 1;
        }

        foreach ($data as $key => $website) {
            $saved = Website::updateOrCreate($website);
        }
    }
}
