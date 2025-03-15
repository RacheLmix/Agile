<?php

namespace App\Controllers\admin;

use App\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Homestay;
use App\Models\Room;
use App\Models\Category;

class UserController extends Controller{
    public function index(){
        return view("admin.layout");
    }
}