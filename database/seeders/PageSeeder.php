<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pages')->insert(array(
            "url" => "https://github.com",
            "title" => "Github",
            "created_at" => date('Y-m-d H:i:s'),
            'favorite' => true,
            'readCount' => 10,  
            "icon" => "https://github.githubassets.com/assets/GitHub-Logo-ee398b662d42.png",
            "user_id" => 1,
            "tag_id" => 1,
        ));
        DB::table('pages')->insert(array(
            "url" => "https://letsignit.com",
            "created_at" => date('Y-m-d H:i:s'),
            "title" => "Letsignit",
            'favorite' => false,
            'readCount' => 10,  
            "icon" => "https://cdn.prod.website-files.com/67bd90ae7191a4fe6076b68d/67bd90ae7191a4fe6076b9af_642edc5c8d1257656775ab18_Vector.svg",
            "user_id" => 1,
            "tag_id" => 1,
        ));
    }
}
