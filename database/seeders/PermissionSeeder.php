<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		app()[PermissionRegistrar::class]->forgetCachedPermissions();

		$userRole = Role::create(['name' => 'user']);
		$adminRole = Role::create(['name' => 'admin']);


		Permission::create(['name' => 'logout']);


		$userRole->givePermissionTo('logout');
		$adminRole->givePermissionTo('logout');


		$user = User::factory()
			->create([
				'name' => 'Alex',
				'email' => 'alex@gmail.com',
				'password' => Hash::make('11112222'),
			]);

		$admin = User::factory()
			->create([
				'name' => 'admin',
				'email' => 'admin@gmail.com',
				'password' => Hash::make('22221111'),
			]);


		$user->assignRole($userRole);
		$admin->assignRole($adminRole);

    }
}
