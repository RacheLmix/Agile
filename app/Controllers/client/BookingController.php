<?php
namespace App\Controllers\client;
use App\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Homestay;
use App\Models\Promotions;

class BookingController extends Controller {
    protected $booking;
    protected $room;
    protected $homestay;
    protected $promotions;

    public function __construct() {
        $this->booking = new Booking();
        $this->room = new Room();
        $this->homestay = new Homestay();
        $this->promotions = new Promotions();
    }

    public function show($homestay_id) {
        $homestay = $this->homestay->find($homestay_id);
        if (!$homestay) {
            header('Location: /');
            exit;
        }

        $check_in = $_GET['check_in'] ?? date('Y-m-d');
        $check_out = $_GET['check_out'] ?? date('Y-m-d', strtotime('+1 day'));
        $nights = (strtotime($check_out) - strtotime($check_in)) / (60 * 60 * 24);
        $nights = max(1, $nights);

        $booking = [
            'homestay_id' => $homestay_id,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'guests' => $_GET['guests'] ?? 1,
            'room_id' => $_GET['room_id'] ?? null,
            'price' => 0,
            'nights' => $nights,
            'name' => '',
            'phone' => '',
            'email' => '',
            'note' => ''
        ];

        // Get error message if exists
        $error = null;
        if (isset($_SESSION['booking_error'])) {
            $error = $_SESSION['booking_error'];
            unset($_SESSION['booking_error']);
        }

        if ($booking['room_id']) {
            $room = $this->room->find($booking['room_id']);
            if ($room) {
                if ($room['status'] !== 'available') {
                    $error = "Phòng này hiện không khả dụng để đặt. Vui lòng chọn phòng khác.";
                }
                
                $booking['room_name'] = $room['name'];
                $booking['original_price'] = $room['price'];
                $booking['price'] = $room['price'];
                $booking['capacity'] = $room['capacity'];
                $booking['status'] = $room['status'];
                $activePromotion = $this->promotions->getActivePromotionForRoom($room['id']);
                if ($activePromotion) {
                    $booking['discount'] = $activePromotion['discount_percent'];
                    $booking['price'] = $room['price'] * (1 - $activePromotion['discount_percent'] / 100);
                }
            }
        }

        view('client.booking', compact('booking', 'homestay', 'error'));
    }

    public function store() {
        $data = $_POST;
        $room = $this->room->find($data['room_id']);
        
        // Check if room is available
        if ($room['status'] !== 'available') {
            $_SESSION['booking_error'] = "Phòng này hiện không khả dụng để đặt. Vui lòng chọn phòng khác.";
            redirect('/booking/' . $room['homestay_id'] . '?room_id=' . $data['room_id']);
            return;
        }
        
        $nights = (strtotime($data['check_out']) - strtotime($data['check_in'])) / (60 * 60 * 24);
        $activePromotion = $this->promotions->getActivePromotionForRoom($data['room_id']);
        $price = $room['price'];
        if ($activePromotion) {
            $price = $room['price'] * (1 - $activePromotion['discount_percent'] / 100);
        }
        
        $total_price = $price * max(1, $nights);
        
        $bookingData = [
            'user_id' => $_SESSION['user']['id'],
            'room_id' => $data['room_id'],
            'check_in' => $data['check_in'],
            'check_out' => $data['check_out'],
            'guests' => $data['guests'],
            'total_price' => $total_price,
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $booking_id = $this->booking->insert($bookingData);
        $this->room->update($data['room_id'], [
            'status' => 'unavailable',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        redirect('/booking/success/' . $booking_id);
    }
    
    public function success($booking_id) {
        $booking = $this->booking->find($booking_id);
        if (!$booking) {
            header('Location: /');
            exit;
        }
        $homestay = $this->homestay->find($booking['homestay_id']);
        $room = $this->room->find($booking['room_id']);
    
        view('client.booking_success', compact('booking', 'homestay', 'room'));
    }
}