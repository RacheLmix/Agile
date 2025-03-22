<?php

namespace App\Controllers\client;

use App\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Homestay;
use App\Models\Room;
use App\Models\Category;

class HomeController extends Controller{
    protected $homestays;
    
    public function __construct()
    {
        $this->homestays = new Homestay();
    }
    public function index(){
        $homestays = $this->homestays->findAllHomestaysWithDetails();
        return view("client.index", compact('homestays'));
    }
}