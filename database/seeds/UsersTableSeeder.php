<?php

use Illuminate\Database\Seeder;
use Blog\User;

class UsersTableSeeder extends Seeder {

    /**
     * Create a new user record in the database.
     *
     * @return void
     */
    public function run() {
        User::create([
            'name'      => 'Mark Guagenti',
            'email'     => 'mark@guagenti.co',
            'password'  => bcrypt('1apple2apple')
        ]);
    }
}
