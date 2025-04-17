<?php

namespace App\Controllers\admin;

use App\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Homestay;
use App\Models\Room;
use App\Models\Category;
use App\Models\Rating;

class RatingController extends Controller
{
    protected $ratings;
    protected $users;
    protected $homestays;

    public function __construct()
    {
        $this->ratings = new Rating();
        $this->users = new User();
        $this->homestays = new Homestay();
    }

    public function index()
    {
        $ratings = $this->ratings->findAllRating();
        view('admin.ratings.index', compact('ratings'));
    }

    public function detail($id)
    {
        $rating = $this->ratings->find($id);
        if (!$rating) {
            $_SESSION['error'] = 'Không tìm thấy đánh giá';
            redirect('/admin/ratings');
        }

        // Fetch related user and homestay
        $user = $this->users->find($rating['user_id']);
        $homestay = $this->homestays->find($rating['homestay_id']);

        return view('admin.ratings.detail', compact('rating', 'user', 'homestay'));
    }
}