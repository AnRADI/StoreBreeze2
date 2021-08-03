<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
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
				'category_id' => 1,
				'name' => 'iPhone X 64GB',
				'description' => 'Отличный продвинутый телефон с памятью на 64 gb',
				'price' => 71990,
			],
			[
				'category_id' => 1,
				'name' => 'iPhone X 256GB',
				'description' => 'Отличный продвинутый телефон с памятью на 256 gb',
				'price' => 89990,
			],
			[
				'category_id' => 1,
				'name' => 'HTC One S',
				'description' => 'Зачем платить за лишнее? Легендарный HTC One S',
				'price' => 12490,
			],
			[
				'category_id' => 1,
				'name' => 'iPhone 5SE',
				'description' => 'Отличный классический iPhone',
				'price' => 17221,
			],
			[
				'category_id' => 2,
				'name' => 'Наушники Beats Audio',
				'description' => 'Отличный звук от Dr. Dre',
				'price' => 20221,
			],
			[
				'category_id' => 2,
				'name' => 'Камера GoPro',
				'description' => 'Снимай самые яркие моменты с помощью этой камеры',
				'price' => 12000,
			],
			[
				'category_id' => 2,
				'name' => 'Камера Panasonic HC-V770',
				'description' => 'Для серьёзной видео съемки нужна серьёзная камера. Panasonic HC-V770 для этих целей лучший выбор!',
				'price' => 27900,
			],
			[
				'category_id' => 3,
				'name' => 'Кофемашина DeLongi',
				'description' => 'Хорошее утро начинается с хорошего кофе!',
				'price' => 25200,
			],
			[
				'category_id' => 3,
				'name' => 'Холодильник Haier',
				'description' => 'Для большой семьи большой холодильник!',
				'price' => 40200,
			],
			[
				'category_id' => 3,
				'name' => 'Блендер Moulinex',
				'description' => 'Для самых смелых идей',
				'price' => 4200,
			],
			[
				'category_id' => 3,
				'name' => 'Мясорубка Bosch',
				'description' => 'Любите домашние котлеты? Вам определенно стоит посмотреть на эту мясорубку!',
				'price' => 9200,
			],
		];


		$count = count($data);
		$code = 1000001;

		for($i = 0; $i < $count; $i++)
		{
			$data[$i]['code'] = $code++;
		}

		\DB::table('products')->insert($data);

    }
}
