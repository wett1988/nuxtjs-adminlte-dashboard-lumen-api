<?php

use Illuminate\Database\Seeder;

use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $roles = [
                [
                    'title' => 'Администратор',
                    'slug' => 'admin'
                ],
            ];

            foreach ($roles as $item){
                Role::create($item);
            }
    }
}
