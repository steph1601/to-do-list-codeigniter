<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['status' => 'todo', 'status_name' => 'To Do'],
            ['status' => 'in_progress', 'status_name' => 'In Progress'],
            ['status' => 'completed', 'status_name' => 'Completed'],
            ['status' => 'on_hold', 'status_name' => 'On Hold'],
            ['status' => 'cancelled', 'status_name' => 'Cancelled']
        ];

        // Inserting the data into the 'status' table
        $this->db->table('status')->insertBatch($data);
    }
}
