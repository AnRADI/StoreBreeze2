<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
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
        		'name' => 'Мобильные телефоны',
				'description' => 'Описание мобильных телефонов'
			],
			[
				'name' => 'Портативная техника',
				'description' => 'Описание портативной техники'
			],
			[
				'name' => 'Бытовая техника',
				'description' => 'Описание бытовой техники'
			],

		];


		$count = count($data);

		for($i = 0; $i < $count; $i++)
		{
			$data[$i]['slug'] =
				Str::slug($data[$i]['name']);
		}



		\DB::table('categories')->insert($data);
    }
}
