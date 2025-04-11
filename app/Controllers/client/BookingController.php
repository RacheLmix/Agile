<?php
namespace App\Controllers\client;
use App\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Homestay;

class BookingController extends Controller {
    protected $booking;
    protected $room;
    protected $homestay;

    public function __construct() {
        $this->booking = new Booking();
        $this->room = new Room();
        $this->homestay = new Homestay();
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

        if ($booking['room_id']) {
            $room = $this->room->find($booking['room_id']);
            if ($room) {
                $booking['room_name'] = $room['name'];
                $booking['price'] = $room['price'];
                $booking['capacity'] = $room['capacity'];
            }
        }

        view('client.booking', compact('booking', 'homestay'));
    }

    public function store() {
        try {
            $data = $_POST;
            
            if (empty($data['homestay_id']) || empty($data['room_id']) || empty($data['check_in']) || empty($data['check_out']) || empty($data['guests'])) {
                throw new \Exception('Vui lòng điền đầy đủ thông tin bắt buộc');
            }

            $room = $this->room->find($data['room_id']);
            if (!$room || $room['status'] !== 'available') {
                throw new \Exception('Phòng không khả dụng');
            }

            // Kiểm tra tính khả dụng của phòng
            if (!$this->booking->checkAvailability($data['room_id'], $data['check_in'], $data['check_out'])) {
                throw new \Exception('Phòng đã được đặt trong khoảng thời gian này');
            }

            $nights = (strtotime($data['check_out']) - strtotime($data['check_in'])) / (60 * 60 * 24);
            $nights = max(1, $nights);
            $total_price = $room['price'] * $nights;

            $bookingData = [
                'homestay_id' => $data['homestay_id'],
                'room_id' => $data['room_id'],
                'user_id' => $_SESSION['user']['id'] ?? null,
                'check_in' => $data['check_in'],
                'check_out' => $data['check_out'],
                'guests' => $data['guests'],
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'note' => $data['note'] ?? null,
                'total_price' => $total_price,
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s')
            ];

            $booking_id = $this->booking->create($bookingData);
            header('Location: /booking/booking_success/' . $booking_id);
            exit;
        } catch (\Exception $e) {
            header('Location: /booking/' . $data['homestay_id'] . '?error=' . urlencode($e->getMessage()));
            exit;
        }
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