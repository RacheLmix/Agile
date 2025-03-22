<?php

namespace App\Controllers\admin;

use App\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Homestay;
use App\Models\Room;
use App\Models\Category;

class RoomController extends Controller{
    protected $rooms;
    protected $homestays;
    public function __construct(){
        $this->rooms = new Room();
        $this->homestays = new Homestay();
    }
    public function index(){
        $rooms = $this->rooms->findrooms();
        return view('admin.room.index', compact('rooms'));
    }
    public function create(){
        $homestays = $this->homestays->findAll();
        return view('admin.room.create', compact('homestays'));
    }
    public function store()
    {
        $data = $_POST + $_FILES;
        if (empty($data['name']) || empty($data['description']) || empty($data['price'])) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin phòng';
            header('Location: /admin/rooms/create');
            exit();
        }
        if(is_upload('image')){
            $data['image'] = $this->uploadFile($data['image'], 'rooms');
        }
        if ($this->rooms->insert($data)) {
            $_SESSION['success'] = 'Thêm phòng mới thành công';
        } else {
            $_SESSION['error'] = 'Có lỗi xảy ra, vui lòng thử lại';
        }
        redirect('/admin/rooms');
    }
    public function edit($id)
    {
        $room = $this->rooms->find($id);
        return view('admin.room.edit', compact('room'));
    }
    public function update($id)
    {

    }
    public function show($id){
        $rooms = $this->rooms->find($id);
        $homestays = $this->homestays->findAll();
        return view('admin.room.details', compact('rooms', 'homestays'));
    }
}