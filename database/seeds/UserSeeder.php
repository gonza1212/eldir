<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'gonzalo',
            'email' => 'email@falso.com',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'gonza1',
            'email' => 'email@re.falso.com',
            'password' => bcrypt('123456'),
            'type' => 'admin',
        ]);
    }
}
