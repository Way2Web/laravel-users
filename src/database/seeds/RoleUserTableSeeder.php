<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', '=', 'admin@admin.com')->first();
        $role = Role::where('name', '=', 'admin')->first();
        if($user && $role){
            DB::table('role_user')->insert([
                'role_id' => $role->id,
                'user_id' => $user->id,
                'created_at' => date('c'),
                'updated_at' => date('c')
            ]);
        }
    }
}
