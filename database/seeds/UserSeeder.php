<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	$this->generateSampleAdminUser();
    }

    /**
	 * Generate a test admin user.
	 *
	 * @return void
	 */
	private function generateSampleAdminUser() 
	{
		if(!User::where('email', 'amal.dileep@digitalmesh.com')->exists()) {
			factory(User::class, 1)->create([
				'email' => 'admin@example.com',
				'password' => '$2y$10$z..e3qsxThkFGpuIbfyqB.RhgzNtxp9MwKZGuUB2D/R66gK34s.P2' //pass@123
			]);
		}
	}
}
