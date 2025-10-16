<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnnouncementSeeder extends Seeder
{    public function run()
    {        $data = [
            [
                'title'      => 'Welcome to MGOD Learning Management System',
                'content'    => 'Welcome to the MGOD Learning Management System! We are happy to have you here and hope this platform helps you learn better.',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'title'      => 'Scheduled System Maintenance',
                'content'    => 'The system will be down for maintenance on October 18, 2025, from 10:00 PM to 2:00 AM. Please save your work before this time and we are sorry for any problems this may cause.',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('announcements')->insertBatch($data);
    }
}
