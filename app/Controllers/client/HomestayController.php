<?php

namespace App\Controllers\client;

use App\Controller;
use App\Models\Homestay;
use App\Models\Room;
use App\Models\Category;

class HomestayController extends Controller{
    protected $homestays;
    
    public function __construct()
    {
        $this->homestays = new Homestay();
    }
    
    public function show($id){
        // Retrieve the homestay with the given ID
        $homestay = $this->homestays->findHomestayWithDetails($id);
        
        if (!$homestay) {
            // If homestay not found, still render the view but with no data
            return view("client.detail");
        }
        
        // Pass the homestay to the view
        return view("client.detail", [
            'homestay' => $homestay
        ]);
    }
    
    // Method to list all homestays (can be used for a separate listing page)
    public function index(){
        $homestays = $this->homestays->findAllHomestaysWithDetails();
        
        if ($homestays === null) {
            $homestays = [];
        }
        
        return view("client.list", [
            'homestays' => $homestays
        ]);
    }
    
    // Method to handle booking requests
    public function book($id){
        // This would be implemented to handle the booking form submission
        // For now it's just a placeholder
        
        $homestay = $this->homestays->findHomestayWithDetails($id);
        
        if (!$homestay) {
            redirect('/');
        }
        
        // Process booking form data
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $checkIn = $_POST['check_in'] ?? null;
            $checkOut = $_POST['check_out'] ?? null;
            $guests = $_POST['guests'] ?? 1;
            
            // Validate input
            if (!$checkIn || !$checkOut) {
                // Return with error
                return view("client.detail", [
                    'homestay' => $homestay,
                    'error' => 'Vui lòng chọn ngày nhận phòng và trả phòng.'
                ]);
            }
            
            // Process booking logic here
            // ...
            
            // Redirect to confirmation page or show success message
            redirect('/booking/success');
        }
        
        // If not a POST request, redirect back to the detail page
        redirect('/homestay/' . $id);
    }
} 