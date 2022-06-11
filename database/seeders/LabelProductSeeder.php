<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LabelProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$data = [
			[
				'product_id' => 1,
				'label_id' => 1
			],
			[
				'product_id' => 1,
				'label_id' => 2
			],
			[
				'product_id' => 2,
				'label_id' => 3
			]
		];


		\DB::table('label_product')->insert($data);
    }
}
