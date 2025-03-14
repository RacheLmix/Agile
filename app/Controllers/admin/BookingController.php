<?php
namespace App\Controllers\admin;
use App\Controller;
use App\Models\Booking;

class BookingController extends Controller{
    protected $booking;
    public function __construct()
    {
        $this->booking = new Booking();
    }
    public function index()
    {
        $booking = $this->booking->FindAllBookings();
        view('admin.booking.index', compact('booking'));
    }
}