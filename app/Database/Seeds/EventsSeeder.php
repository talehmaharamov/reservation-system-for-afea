<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EventsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Afea Event 1',
                'date' => '2024-01-15',
                'total_seats' => 510,
            ],
            [
                'name' => 'Afea Event 2',
                'date' => '2024-01-16',
                'total_seats' => 510,
            ],
            [
                'name' => 'Afea Event 3',
                'date' => '2024-01-17',
                'total_seats' => 15,
            ],
        ];

        foreach ($data as $event) {
            $this->db->table('events')->insert($event);
        }
    }
}
