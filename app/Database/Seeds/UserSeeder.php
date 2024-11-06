<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Password;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'first_name' => 'user1',
            'last_name' => 'lastname',
            'email'    => 'user@user.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
        ];

        $this->db->table('users')->insert($data);
        
    }
}
