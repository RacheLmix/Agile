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
        view('client.profile.index', compact('user'));
    }
    public function edit($id)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
        }
        $user = $this->users->find($id);
        if (!$user) {
            header('Location: /login');
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
        return view('client.profile.order', compact('bookings'));
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
            'status' => 'confirmed',
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
        
        // Check if booking exists and belongs to the current user
        if (!$bookingData || $bookingData['user_id'] != $user_id) {
            $_SESSION['error'] = 'Không tìm thấy đơn đặt phòng hoặc bạn không có quyền truy cập.';
            redirect('/orderview');
            return;
        }
        
        // Check if booking can be cancelled (only pending bookings)
        if ($bookingData['status'] != 'pending') {
            $_SESSION['error'] = 'Chỉ có thể hủy đơn đặt phòng đang chờ xác nhận.';
            redirect('/orderview');
            return;
        }
        
        // Update booking status to cancelled
        $booking->update($id, [
            'status' => 'cancelled',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        // Make the room available again
        $this->rooms->update($bookingData['room_id'], [
            'status' => 'available'
        ]);
        
        $_SESSION['success'] = 'Đã hủy đơn đặt phòng thành công!';
        redirect('/orderview');
    }
}
