<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	//Category::factory(4)->create();
		$this->call([
			CategorySeeder::class,
			ProductSeeder::class,
			CategoryProductSeeder::class,
			PermissionSeeder::class,
		]);
    }
}
