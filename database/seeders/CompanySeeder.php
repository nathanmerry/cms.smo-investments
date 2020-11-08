<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(file_get_contents('./database/seeders/CompanySeeder.json'), true);

        foreach ($data as $key => $company) {
            $data[$key] = array_change_key_case($data[$key], CASE_LOWER);
        }

        $query = DB::getSchemaBuilder()->getColumnListing('company');
        
        foreach ($data as $key => $company) {
            $filtered = array_filter(
                $company,
                function ($key) use ($query) {
                    return in_array($key, $query);
                },
                ARRAY_FILTER_USE_KEY
            );

            $saved = Company::updateOrCreate($filtered);
        }
    }
}
