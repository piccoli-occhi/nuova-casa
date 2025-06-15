<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert(array(
            "name" => "Letsignit",
            "created_at" => date('Y-m-d H:i:s'),
            "icon" => "https://cdn.prod.website-files.com/67bd90ae7191a4fe6076b68d/67bd90ae7191a4fe6076b9af_642edc5c8d1257656775ab18_Vector.svg",
            "color" => "#FF604F",
            "user_id" => 1,
        ));
    }
}
