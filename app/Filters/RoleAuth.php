<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleAuth implements FilterInterface
{    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();
        
        // Debug logging
        log_message('info', 'RoleAuth Filter - Session Data: ' . json_encode([
            'isLoggedIn' => $session->get('isLoggedIn'),
            'role' => $session->get('role'),
            'userID' => $session->get('userID'),
            'name' => $session->get('name')
        ]));
        
        // Check if user is logged in
        if ($session->get('isLoggedIn') !== true) {
            log_message('info', 'RoleAuth Filter - User not logged in, redirecting to login');
            $session->setFlashdata('error', 'Please login to access this page.');
            return redirect()->to(base_url('login'));
        }
        
        $userRole = $session->get('role');
        
        // Get the current URI segment
        $uri = service('uri');
        $segment1 = $uri->getSegment(1); // First segment of the URL
        
        log_message('info', 'RoleAuth Filter - User role: ' . $userRole . ', Segment: ' . $segment1);
        
        // Role-based access control
        if ($userRole === 'admin') {
            // Admins can access admin routes and announcements
            if ($segment1 === 'admin' || $segment1 === 'announcements') {
                log_message('info', 'RoleAuth Filter - Admin access granted');
                return null; // Allow access
            }
        } elseif ($userRole === 'teacher') {
            // Teachers can access teacher routes and announcements
            if ($segment1 === 'teacher' || $segment1 === 'announcements') {
                log_message('info', 'RoleAuth Filter - Teacher access granted');
                return null; // Allow access
            }
        } elseif ($userRole === 'student') {
            // Students can access student routes and announcements
            if ($segment1 === 'student' || $segment1 === 'announcements') {
                log_message('info', 'RoleAuth Filter - Student access granted');
                return null; // Allow access
            }
        }
        
        // If we reach here, access is denied
        log_message('info', 'RoleAuth Filter - Access denied for role: ' . $userRole . ' trying to access: ' . $segment1);
        $session->setFlashdata('error', 'Access Denied: Insufficient Permissions');
        return redirect()->to(base_url('announcements'));
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing after
        return $response;
    }
}
