<?php

namespace App\Controllers\client;

use App\Controller;
use App\Models\User;
use App\Models\Room;
use App\Models\Category;
use App\Models\Booking;
use App\Models\Promotions;
use App\Models\Homestay;

class ProfileController extends Controller
{
    protected $users;
    protected $rooms;
    protected $homestays;
    protected $categories;
    protected $Promotions;

    public function __construct()
    {
        $this->users = new User();
        $this->rooms = new Room();
        $this->homestays = new Homestay();
        $this->categories = new Category();
        $this->Promotions = new Promotions();
    }

    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $user = $this->users->find($userId);

        if (!$user) {
            header('Location: /login');
            exit;
        }

        // Fetch homestays where the user is the host
        $homestays = $this->homestays->findByHost($userId) ?? [];
        
        // Manually attach amenities to each homestay
        foreach ($homestays as &$homestay) {
            $homestay['amenities'] = $this->homestays->getAmenities($homestay['id']) ?? [];
        }

        // Fetch user's bookings
        $bookingModel = new Booking();
        $bookings = $bookingModel->findUserBookings($userId) ?? [];

        // Attach homestay and room details to bookings
        foreach ($bookings as &$booking) {
            $room = $this->rooms->find($booking['room_id']);
            $homestay = $room ? $this->homestays->find($room['homestay_id']) : null;

            $booking['room'] = [
                'name' => $room['name'] ?? 'Unknown Room'
            ];
            $booking['homestay'] = [
                'name' => $homestay['name'] ?? 'Unknown Homestay'
            ];
            $booking['nights'] = (strtotime($booking['check_out']) - strtotime($booking['check_in'])) / (60 * 60 * 24);
        }

        view('client.profile.index', compact('user', 'homestays', 'bookings'));
    }

    public function edit($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $user = $this->users->find($id);
        if (!$user) {
            header('Location: /login');
            exit;
        }

        view('client.profile.update', compact('user'));
    }

    public function update($id)
    {
        $data = $_POST + $_FILES;
        $user = $this->users->find($id);

        if (is_upload('avatar')) {
            $data['avatar'] = $this->uploadFile($data['avatar'], 'avatar');
            if ($user['avatar'] && file_exists($user['avatar'])) {
                unlink($user['avatar']);
            }
        } else {
            $data['avatar'] = $user['avatar'];
        }

        $this->users->update($id, $data);
        redirect('/profile');
    }

    public function orderview()
    {
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['id'])) {
            redirect('/login');
            return;
        }
        $user_id = $_SESSION['user']['id'];
        $user = $this->users->find($user_id);
        $booking = new Booking();
        $bookings = $booking->findUserBookings($user_id);
        if (!$bookings) {
            $bookings = [];
        }

        foreach ($bookings as &$booking) {
            $room = $this->rooms->find($booking['room_id']);
            $homestay = $this->homestays->find($room['homestay_id']);

            $booking['room_name'] = $room['name'] ?? 'Unknown Room';
            $booking['homestay_name'] = $homestay['name'] ?? 'Unknown Homestay';
            $booking['nights'] = (strtotime($booking['check_out']) - strtotime($booking['check_in'])) / (60 * 60 * 24);
        }

        return view('client.profile.order', compact('bookings', 'user'));
    }

    public function orderDetail($id)
    {
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['id'])) {
            redirect('/login');
            return;
        }

        $user_id = $_SESSION['user']['id'];
        $user = $this->users->find($user_id);
        $bookingModel = new Booking();
        $booking = $bookingModel->find($id);

        if (!$booking || $booking['user_id'] != $user_id) {
            return view('client.profile.order_detail', [
                'error' => 'Không tìm thấy đơn đặt phòng hoặc bạn không có quyền truy cập.'
            ]);
        }

        $room = $this->rooms->find($booking['room_id']);
        $homestay = $room ? $this->homestays->find($room['homestay_id']) : null;
        $amenities = $homestay ? $this->homestays->getAmenities($homestay['id']) : [];

        $booking['room'] = [
            'name' => $room['name'] ?? 'Unknown Room'
        ];
        $booking['homestay'] = [
            'name' => $homestay['name'] ?? 'Unknown Homestay'
        ];
        $booking['nights'] = (strtotime($booking['check_out']) - strtotime($booking['check_in'])) / (60 * 60 * 24);

        return view('client.profile.order_detail', compact('booking', 'homestay', 'room', 'amenities', 'user'));
    }

    public function checkin($id)
    {
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['id'])) {
            redirect('/login');
            return;
        }

        $user_id = $_SESSION['user']['id'];
        $booking = new Booking();
        $bookingData = $booking->find($id);

        if (!$bookingData || $bookingData['user_id'] != $user_id) {
            $_SESSION['error'] = 'Không tìm thấy đơn đặt phòng hoặc bạn không có quyền truy cập.';
            redirect('/orderview');
            return;
        }

        $booking->update($id, [
            'status' => 'completed', // Changed from 'confirmed' to 'completed'
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $_SESSION['success'] = 'Đã xác nhận check-in thành công!';
        redirect('/orderview');
    }

    public function cancelBooking($id)
    {
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['id'])) {
            redirect('/login');
            return;
        }

        $user_id = $_SESSION['user']['id'];
        $booking = new Booking();
        $bookingData = $booking->find($id);

        if (!$bookingData || $bookingData['user_id'] != $user_id) {
            $_SESSION['error'] = 'Không tìm thấy đơn đặt phòng hoặc bạn không có quyền truy cập.';
            redirect('/orderview');
            return;
        }

        if ($bookingData['status'] != 'pending') {
            $_SESSION['error'] = 'Chỉ có thể hủy đơn đặt phòng đang chờ xác nhận.';
            redirect('/orderview');
            return;
        }

        $booking->update($id, [
            'status' => 'cancelled',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $this->rooms->update($bookingData['room_id'], [
            'status' => 'available'
        ]);

        $_SESSION['success'] = 'Đã hủy đơn đặt phòng thành công!';
        redirect('/orderview');
    }
}