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
        $source = User::where('email', '=', 'cms@intothesource.com')->first();
        $source_role = Role::where('name', '=', 'source')->first();
        if($source && $source_role){
            DB::table('role_user')->insert([
                'role_id' => $source->id,
                'user_id' => $source_role->id,
                'created_at' => date('c'),
                'updated_at' => date('c')
            ]);
        }
        $admin = User::where('email', '=', 'admin@admin.com')->first();
        $admin_role = Role::where('name', '=', 'admin')->first();
        if($admin && $admin_role){
            DB::table('role_user')->insert([
                'role_id' => $admin->id,
                'user_id' => $admin_role->id,
                'created_at' => date('c'),
                'updated_at' => date('c')
            ]);
        }
    }
}
