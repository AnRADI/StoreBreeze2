<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
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
				'name' => 'Новинка',
				'class' => 'badge-success'
			],
			[
				'name' => 'Рекомендуем',
				'class' => 'badge-warning'
			],
			[
				'name' => 'Хит продаж!',
				'class' => 'badge-danger'
			],

		];


		$count = count($data);

		for($i = 0; $i < $count; $i++)
		{
			$data[$i]['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
			$data[$i]['updated_at'] = $data[$i]['created_at'];
		}


		\DB::table('labels')->insert($data);
    }
}
