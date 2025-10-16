<?php

namespace App\Controllers;

class Admin extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function dashboard()
    {
        // Check if user is logged in
        if ($this->session->get('isLoggedIn') !== true) {
            $this->session->setFlashdata('error', 'Please login to access the dashboard.');
            return redirect()->to(base_url('login'));
        }        // Check if user has admin role
        if ($this->session->get('role') !== 'admin') {
            $this->session->setFlashdata('error', 'Access denied. This area is for administrators only.');
            return redirect()->to(base_url('announcements'));
        }

        $data = [
            'title' => 'Admin Dashboard - MGOD LMS',
            'user' => [
                'userID' => $this->session->get('userID'),
                'name'   => $this->session->get('name'),
                'email'  => $this->session->get('email'),
                'role'   => $this->session->get('role')
            ]
        ];

        return view('admin/admin_dashboard', $data);
    }
}
