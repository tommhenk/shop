<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('users')->insertGetId([
            'name'=>'Admin',
            'login'=>'admin',
            'email'=>'admin@example.com',
            'password'=>bcrypt('admin'),
        ]);

        $user = User::findOrFail($id)->roles()->attach(\App\Models\Role::where('name', 'admin')->first()->id);
    }
}
