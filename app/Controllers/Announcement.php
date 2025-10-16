<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnnouncementModel;
use CodeIgniter\HTTP\ResponseInterface;

class Announcement extends BaseController
{
    protected $announcementModel;
    protected $session;

    public function __construct()
    {
        $this->announcementModel = new AnnouncementModel();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        if ($this->session->get('isLoggedIn') !== true) {
            $this->session->setFlashdata('error', 'Please login to view announcements.');
            return redirect()->to(base_url('login'));
        }

        $announcements = $this->announcementModel->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'title' => 'Announcements - MGOD LMS',
            'announcements' => $announcements,
            'user' => [
                'userID' => $this->session->get('userID'),
                'name'   => $this->session->get('name'),
                'email'  => $this->session->get('email'),
                'role'   => $this->session->get('role')
            ]
        ];

        return view('auth/announcement', $data);
    }
}
