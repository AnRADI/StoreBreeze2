<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Permission::create(['name' => 'login and register']);
		Permission::create(['name' => 'logout']);

		$guestRole = Role::create(['name' => 'guest']);
		$userRole = Role::create(['name' => 'user']);
		$adminRole = Role::create(['name' => 'admin']);

		$guestRole->givePermissionTo('login and register');
		$userRole->givePermissionTo('logout');


		$guest = User::factory()
			->create([
				'name' => 'guest',
			]);

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


//		$zero = User::factory(2)->create(['name' => 'Pis']);
		$guest->assignRole($guestRole);
		$user->assignRole($userRole);
		$admin->assignRole($adminRole);

    }
}
