<?php
namespace App\Controllers\admin;
use App\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use App\Models\Homestay;
use App\Models\Amenity;

class BookingController extends Controller{
    protected $booking;
    protected $user;
    protected $room;
    protected $homestay;
    protected $amenity;
    
    public function __construct()
    {
        $this->booking = new Booking();
        $this->user = new User();
        $this->room = new Room();
        $this->homestay = new Homestay();
        $this->amenity = new Amenity();
    }
    public function index()
    {
        $booking = $this->booking->FindAllBookings();
        view('admin.booking.index', compact('booking'));
    }
    public function details($id)
    {
        $booking = $this->booking->find($id);
        $room = $this->room->findAll();
        $user = $this->user->findAll();
        
        // Get the room details
        $roomDetails = null;
        foreach($room as $r) {
            if($r['id'] == $booking['room_id']) {
                $roomDetails = $r;
                break;
            }
        }
        
        $homestayDetails = null;
        $amenities = [];
        if($roomDetails) {
            $homestayDetails = $this->homestay->findHomestayWithDetails($roomDetails['homestay_id']);
            $amenities = $this->homestay->getAmenities($roomDetails['homestay_id']);
        }
        
        $checkIn = new \DateTime($booking['check_in']);
        $checkOut = new \DateTime($booking['check_out']);
        $duration = $checkIn->diff($checkOut)->days;
        
        view('admin.booking.details', compact('booking', 'room', 'user', 'homestayDetails', 'amenities', 'duration'));
    }
    public function edit($id)
    {
        $booking = $this->booking->find($id);
        $room = $this->room->findAll();
        $user = $this->user->findAll();
        $csrfToken = bin2hex(random_bytes(32));
        view('admin.booking.edit', compact('booking', 'room', 'user', 'csrfToken'));
    }

    public function update($id)
    {
        try {
            $data = $_POST;
            $updateData = ['status' => $data['status']];
            
            $this->booking->update($id, $updateData);
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        } catch (\Exception $e) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit;
        }
    }




}