<?php
namespace App\Controllers\admin;
use App\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;

class BookingController extends Controller{
    protected $booking;
    protected $user;
    protected $room;
    public function __construct()
    {
        $this->booking = new Booking();
        $this->user = new User();
        $this->room = new Room();
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
        view('admin.booking.details', compact('booking', 'room', 'user'));
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