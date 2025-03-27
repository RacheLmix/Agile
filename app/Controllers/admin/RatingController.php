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
    public function __construct()
    {
        $this->ratings = new Rating();
        $this->users = new User();
    }
    public function index()
    {
        $ratings = $this->ratings->findAllRating();
        view('admin.ratings.index', compact('ratings'));
    }
}