<?php

namespace App\Controllers\admin;

use App\Controller;
use App\Models\Homestay;

class HomestayController extends Controller{
    protected $homestay;
    public function __construct()
    {
        $this->homestay = new Homestay();
    }
    public function index(){
        $homestay = $this->homestay->findAllHomestaysWithDetails();
        view('admin.homestays.index', compact('homestay'));
    }
}