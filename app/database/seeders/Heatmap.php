<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Heatmap extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $links = ['https://www.emag.ro/', 'https://www.olx.ro/', 'https://www.publi24.ro/', 'https://www.aradon.ro/', 'https://www.click.ro/'];
        $types = ['product', 'category', 'static-page', 'checkout', 'homepage'];

        for ($i = 1; $i <= 20; $i++) {
            DB::table('links')->insert([
                'id' => random_int(1, 99999),
                'link' => $links[array_rand($links)],
                'link_type' => $types[array_rand($types)],
                'user_id' => random_int(1, 3),
                'created_at' => date('Y-m-d H:i:s', time() - $i * rand(100, 1000000))
            ]);
        }
        DB::table('journeys')->insert([
            [
                'user_id' => 1,
                'links' => '[{"link":"https:\/\/emag.ro\/"}]'
            ],
            [
                'user_id' => 2,
                'links' => '[{"link":"https:\/\/emag.ro\/"}]'
            ],
            [
                'user_id' => 3,
                'links' => '[{"link":"https:\/\/emag.ro\/"}]'
            ],
            [
                'user_id' => 4,
                'links' => '[{"link":"https:\/\/olx.ro\/"}]'
            ],
        ]);
    }

}
