<?php

namespace App\Controllers\client;

use App\Controller;
use App\Models\Homestay;
use App\Models\Room;
use App\Models\Category;
use App\Models\Booking;

class HomestayController extends Controller{
    protected $homestays;
    protected $rooms;
    protected $categories;
    
    public function __construct()
    {
        $this->homestays = new Homestay();
        $this->rooms = new Room();
        $this->categories = new Category();
    }
    
    // Homepage with all homestays
    public function index(){
        $homestays = $this->homestays->findAllHomestaysWithDetails();
        $categories = $this->categories->findAll();
        
        if ($homestays === null) {
            $homestays = [];
        }
        
        return view("client.list", compact('homestays', 'categories'));
    }
    public function detail($id){
        // Get the homestay with all related details
        $homestay = $this->homestays->findHomestayWithDetails($id);
        
        if (!$homestay) {
            // If homestay not found, redirect to homepage
            redirect('/');
        }
        
        // Get rooms associated with this homestay
        $rooms = $this->rooms->findByHomestay($id);
        
        // Get similar homestays in the same category or location
        $similar_homestays = $this->homestays->findSimilarHomestays($homestay['category_id'], $homestay['location'], $id, 3);
        
        // Get categories for sidebar or filters
        $categories = $this->categories->findAll();
        
        // Pass all data to the view
        return view('client.detail', compact('homestay', 'rooms', 'similar_homestays', 'categories'));
    }
    
    // Search homestays by criteria
    public function search(){
        $keyword = $_GET['keyword'] ?? '';
        $location = $_GET['location'] ?? '';
        $category_id = $_GET['category_id'] ?? '';
        $price_min = $_GET['price_min'] ?? 0;
        $price_max = $_GET['price_max'] ?? 10000000;
        
        $homestays = $this->homestays->searchHomestays($keyword, $location, $category_id, $price_min, $price_max);
        $categories = $this->categories->findAll();
        
        return view("client.list", [
            'homestays' => $homestays,
            'categories' => $categories,
            'search' => [
                'keyword' => $keyword,
                'location' => $location,
                'category_id' => $category_id,
                'price_min' => $price_min,
                'price_max' => $price_max
            ]
        ]);
    }
    
    // Filter homestays by category
    public function filterByCategory($category_id){
        $homestays = $this->homestays->findByCategory($category_id);
        $category = $this->categories->find($category_id);
        $categories = $this->categories->findAll();
        
        return view("client.list", compact('homestays', 'category', 'categories'));
    }
    
    // Filter homestays by location
    public function filterByLocation($location){
        $homestays = $this->homestays->findByLocation($location);
        $categories = $this->categories->findAll();
        
        return view("client.list", [
            'homestays' => $homestays, 
            'categories' => $categories,
            'location' => $location
        ]);
    }
    
    // Method to handle booking requests
    public function book($id){
        // This would be implemented to handle the booking form submission
        $homestay = $this->homestays->findHomestayWithDetails($id);
        
        if (!$homestay) {
            redirect('/');
        }
        
        // Process booking form data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $checkIn = $_POST['check_in'] ?? null;
            $checkOut = $_POST['check_out'] ?? null;
            $guests = $_POST['guests'] ?? 1;
            $room_id = $_POST['room_id'] ?? null;
            
            // Validate input
            if (!$checkIn || !$checkOut) {
                // Return with error
                return view("client.detail", [
                    'homestay' => $homestay,
                    'error' => 'Vui lòng chọn ngày nhận phòng và trả phòng.',
                    'rooms' => $this->homestays->getRooms($id)
                ]);
            }
            
            // // Check room availability
            // if ($room_id) {
            //     $isAvailable = $this->rooms->checkAvailability($room_id, $checkIn, $checkOut);
            //     if (!$isAvailable) {
            //         return view("client.detail", [
            //             'homestay' => $homestay,
            //             'error' => 'Phòng đã được đặt trong khoảng thời gian này. Vui lòng chọn ngày khác.',
            //             'rooms' => $this->homestays->getRooms($id)
            //         ]);
            //     }
            // }
            
            // Process booking logic here
            // Save booking to database and redirect to payment
            
            // Example of saving booking:
            $bookingData = [
                'homestay_id' => $id,
                'room_id' => $room_id,
                'user_id' => $_SESSION['user_id'] ?? null, // Assuming user is logged in
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'guests' => $guests,
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            // If you have a Booking model:
            // $booking = new Booking();
            // $booking_id = $booking->insert($bookingData);
            // redirect('/booking/payment/' . $booking_id);
            
            // For now just redirect to success
            redirect('/booking/success');
        }
        
        // If not a POST request, redirect back to the detail page
        redirect('/homestay/' . $id);
    }
    
    // View room details
    public function roomDetail($homestay_id, $room_id) {
        $homestay = $this->homestays->findHomestayWithDetails($homestay_id);
        $room = $this->rooms->find($room_id);
        
        if (!$homestay || !$room) {
            redirect('/');
        }
        
        return view("client.room_detail", compact('homestay', 'room'));
    }
} 