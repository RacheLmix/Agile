<?php

namespace App\Controllers\admin;

use App\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Homestay;
use App\Models\Room;
use App\Models\Category;

class HomeController extends Controller{
    public function index(){
        // Get total users
        $userModel = new User();
        $totalUsers = count($userModel->fetchUsers());
        
        // Get total bookings
        $bookingModel = new Booking();
        $totalBookings = count($bookingModel->FindAllBookings());
        
        // Get total homestays
        $homestayModel = new Homestay();
        $totalHomestays = count($homestayModel->findAllHomestaysWithDetails());
        
        // Get total rooms
        $roomModel = new Room();
        $totalRooms = count($roomModel->findrooms());
        
        // Get recent bookings
        $recentBookings = array_slice($bookingModel->FindAllBookings(), 0, 5);
        
        // Get top rated homestays
        $topRatedHomestays = array_slice($homestayModel->findAllHomestaysWithDetails(), 0, 5);
        
        // Get booking statistics by status
        $bookingStats = [];
        $allBookings = $bookingModel->FindAllBookings();
        $statusCounts = [];
        foreach ($allBookings as $booking) {
            $status = $booking['status'];
            if (!isset($statusCounts[$status])) {
                $statusCounts[$status] = 0;
            }
            $statusCounts[$status]++;
        }
        foreach ($statusCounts as $status => $count) {
            $bookingStats[] = [
                'status' => $status,
                'count' => $count
            ];
        }
            
        // Get total revenue
        $totalRevenue = 0;
        foreach ($allBookings as $booking) {
            if ($booking['status'] === 'confirmed') {
                $totalRevenue += $booking['total_price'];
            }
        }
        
        return view("admin.dashboard", [
            'totalUsers' => $totalUsers,
            'totalBookings' => $totalBookings,
            'totalHomestays' => $totalHomestays,
            'totalRooms' => $totalRooms,
            'recentBookings' => $recentBookings,
            'topRatedHomestays' => $topRatedHomestays,
            'bookingStats' => $bookingStats,
            'totalRevenue' => $totalRevenue
        ]);
    }
}