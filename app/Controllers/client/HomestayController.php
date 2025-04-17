<?php

namespace App\Controllers\client;

use App\Controller;
use App\Models\Homestay;
use App\Models\Room;
use App\Models\Category;
use App\Models\Booking;
use App\Models\Promotions;
use App\Models\Rating;
use App\Models\User;

class HomestayController extends Controller
{
    protected $homestays;
    protected $rooms;
    protected $categories;
    protected $promotions;
    protected $bookings;
    protected $ratings;
    protected $users;

    public function __construct()
    {
        $this->homestays = new Homestay();
        $this->rooms = new Room();
        $this->categories = new Category();
        $this->promotions = new Promotions();
        $this->bookings = new Booking();
        $this->ratings = new Rating();
        $this->users = new User();
    }

    public function detail($id)
    {
        $homestay = $this->homestays->findHomestayWithDetails($id);
        if (!$homestay) {
            view('client.detail', ['error' => 'Không tìm thấy homestay']);
            return;
        }
        $rooms = $this->homestays->getRooms($id);
        $amenities = $this->homestays->getAmenities($id);
        $ratings = $this->homestays->getRatings($id);

        $promotions = new Promotions();
        foreach ($rooms as &$room) {
            $roomPromotions = $promotions->getRoomPromotions($room['id']);
            if (!empty($roomPromotions)) {
                $room['discount'] = $roomPromotions[0]['discount_percent'];
                $room['promotion_title'] = $roomPromotions[0]['title'];
            }
        }

        // Kiểm tra xem người dùng có thể đánh giá không
        $canRate = false;
        $userId = $_SESSION['user_id'] ?? null;
        $existingRating = null;
        if ($userId) {
            // Sử dụng model Booking để kiểm tra
            $canRate = $this->bookings->canUserRate($userId, $id);

            // Sử dụng model Rating để kiểm tra xem đã đánh giá chưa
            $existingRating = $this->ratings->hasUserRated($userId, $id);
        }

        // Xử lý gửi đánh giá
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_rating']) && $canRate && !$existingRating) {
            $score = $_POST['score'] ?? 0;
            $content = $_POST['content'] ?? '';

            // Validate score
            if ($score < 0 || $score > 5) {
                $error = "Điểm số phải từ 0 đến 5.";
            } else {
                // Sử dụng model Rating để lưu đánh giá
                $success = $this->ratings->createRating($userId, $id, $score, $content);
                if ($success) {
                    // Chuyển hướng để tránh gửi lại form
                    redirect('/homestay/' . $id);
                } else {
                    $error = "Có lỗi xảy ra khi gửi đánh giá. Vui lòng thử lại.";
                }
            }
        }

        view('client.detail', compact('homestay', 'rooms', 'amenities', 'ratings', 'canRate', 'existingRating', 'error'));
    }

    // Các phương thức khác giữ nguyên
    public function index()
    {
        $homestays = $this->homestays->findAllHomestaysWithDetails();
        $categories = $this->categories->findAll();

        if ($homestays === null) {
            $homestays = [];
        }

        return view("client.list", compact('homestays', 'categories'));
    }

    public function search()
    {
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

    public function filterByCategory($category_id)
    {
        $homestays = $this->homestays->findByCategory($category_id);
        $category = $this->categories->find($category_id);
        $categories = $this->categories->findAll();

        return view("client.list", compact('homestays', 'category', 'categories'));
    }

    public function filterByLocation($location)
    {
        $homestays = $this->homestays->findByLocation($location);
        $categories = $this->categories->findAll();

        return view("client.list", [
            'homestays' => $homestays,
            'categories' => $categories,
            'location' => $location
        ]);
    }

    public function book($id)
    {
        $homestay = $this->homestays->findHomestayWithDetails($id);

        if (!$homestay) {
            redirect('/');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $checkIn = $_POST['check_in'] ?? null;
            $checkOut = $_POST['check_out'] ?? null;
            $guests = $_POST['guests'] ?? 1;
            $room_id = $_POST['room_id'] ?? null;
            $amenities = isset($_POST['amenities']) ? implode(', ', $_POST['amenities']) : null;

            if (!$checkIn || !$checkOut || !$room_id) {
                return view("client.detail", [
                    'homestay' => $homestay,
                    'error' => 'Vui lòng chọn ngày nhận phòng, trả phòng và phòng.',
                    'rooms' => $this->homestays->getRooms($id),
                    'amenities' => $this->homestays->getAmenities($id),
                    'ratings' => $this->homestays->getRatings($id)
                ]);
            }

            // Lấy thông tin người dùng
            $userId = $_SESSION['user_id'] ?? null;
            if (!$userId) {
                return view("client.detail", [
                    'homestay' => $homestay,
                    'error' => 'Vui lòng đăng nhập để đặt phòng.',
                    'rooms' => $this->homestays->getRooms($id),
                    'amenities' => $this->homestays->getAmenities($id),
                    'ratings' => $this->homestays->getRatings($id)
                ]);
            }

            // Lấy thông tin phòng để tính tổng giá
            $room = $this->rooms->find($room_id);
            if (!$room) {
                return view("client.detail", [
                    'homestay' => $homestay,
                    'error' => 'Phòng không tồn tại.',
                    'rooms' => $this->homestays->getRooms($id),
                    'amenities' => $this->homestays->getAmenities($id),
                    'ratings' => $this->homestays->getRatings($id)
                ]);
            }

            // Tính tổng giá (giả sử giá phòng * số ngày)
            $checkInDate = new \DateTime($checkIn);
            $checkOutDate = new \DateTime($checkOut);
            $days = $checkInDate->diff($checkOutDate)->days;
            $totalPrice = $room['price'] * $days;

            // Lấy thông tin người dùng bằng model User
            $user = $this->users->findById($userId);
            if (!$user) {
                return view("client.detail", [
                    'homestay' => $homestay,
                    'error' => 'Không tìm thấy thông tin người dùng.',
                    'rooms' => $this->homestays->getRooms($id),
                    'amenities' => $this->homestays->getAmenities($id),
                    'ratings' => $this->homestays->getRatings($id)
                ]);
            }

            $bookingData = [
                'user_id' => $userId,
                'homestay_id' => $id,
                'room_id' => $room_id,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'guests' => $guests,
                'amenity' => $amenities,
                'total_price' => $totalPrice,
                'status' => 'confirmed', // Đặt trạng thái là confirmed ngay lập tức
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'full_name' => $user['full_name'],
                'email' => $user['email']
            ];

            // Lưu đặt phòng
            $bookingId = $this->bookings->create($bookingData);
            if ($bookingId) {
                redirect('/booking/success/' . $bookingId);
            } else {
                return view("client.detail", [
                    'homestay' => $homestay,
                    'error' => 'Có lỗi khi lưu đặt phòng. Vui lòng thử lại.',
                    'rooms' => $this->homestays->getRooms($id),
                    'amenities' => $this->homestays->getAmenities($id),
                    'ratings' => $this->homestays->getRatings($id)
                ]);
            }
        }

        redirect('/homestay/' . $id);
    }

    public function roomDetail($homestay_id, $room_id)
    {
        $homestay = $this->homestays->findHomestayWithDetails($homestay_id);
        $room = $this->rooms->find($room_id);

        if (!$homestay || !$room) {
            redirect('/');
        }

        return view("client.room_detail", compact('homestay', 'room'));
    }
    
}
