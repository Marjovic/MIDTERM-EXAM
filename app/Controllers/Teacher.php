<?php

namespace App\Controllers;

class Teacher extends BaseController
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
        }

        // Check if user has teacher role
        if ($this->session->get('role') !== 'teacher') {
            $this->session->setFlashdata('error', 'Access denied. This area is for teachers only.');
            return redirect()->to(base_url('dashboard'));
        }

        $data = [
            'title' => 'Teacher Dashboard - MGOD LMS',
            'user' => [
                'userID' => $this->session->get('userID'),
                'name'   => $this->session->get('name'),
                'email'  => $this->session->get('email'),
                'role'   => $this->session->get('role')
            ]
        ];

        return view('teacher/teacher_dashboard', $data);
    }
}
