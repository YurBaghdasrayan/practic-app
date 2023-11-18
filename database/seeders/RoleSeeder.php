<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('roles')->insert([
			[
				'id' => Role::USER_ID,
				'name' => 'user',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'id' => Role::ADMIN_ID,
				'name' => 'admin',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
			[
				'id' => Role::MODERATOR_ID,
				'name' => 'moderator',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			],
		]);
	}
}
