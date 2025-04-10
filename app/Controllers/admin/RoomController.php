<?php

namespace App\Controllers\admin;

use App\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Homestay;
use App\Models\Room;
use App\Models\Category;
use App\Models\Promotions;
class RoomController extends Controller
{
    protected $rooms;
    protected $homestays;
    protected $promotions;

    public function __construct()
    {
        $this->rooms = new Room();
        $this->homestays = new Homestay();
        $this->promotions = new Promotions();
    }

    public function index()
    {
        $rooms = $this->rooms->findrooms();
        foreach ($rooms as &$room) {
            $promotions = $this->promotions->getRoomPromotions($room['id']);
            $room['promotions'] = $promotions;
        }
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $homestays = $this->homestays->findAll();
        return view('admin.rooms.create', compact('homestays'));
    }

    public function store()
    {
        $data = $_POST + $_FILES;
        if (empty($data['name']) || empty($data['description']) || empty($data['price'])) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin phòng';
            redirect('/admin/rooms/create');
        }
        if (is_upload('image1')) {
            $data['image1'] = $this->uploadFile($data['image1'], 'rooms');
        }
        for ($i = 2; $i <= 4; $i++) {
            if (is_upload("image$i")) {
                $data["image$i"] = $this->uploadFile($data["image$i"], 'rooms');
            } else {
                $data["image$i"] = null;
            }
        }

        $this->rooms->insert($data);
        redirect('/admin/rooms');
    }

    public function edit($id)
    {
        $room = $this->rooms->find($id);
        $homestays = $this->homestays->findAll();
        return view('admin.rooms.edit', compact('room', 'homestays'));
    }

    public function update($id)
    {
        $data = $_POST + $_FILES;
        $room = $this->rooms->find($id);
        if (empty($data['name']) || empty($data['description']) || empty($data['price'])) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin phòng';
            redirect('/admin/rooms/edit/' . $id);
        }
        if (!empty($_FILES['image1']) && $_FILES['image1']['error'] == 0) {
            $data['image1'] = $this->uploadFile($_FILES['image1'], 'rooms');
        } else {
            $data['image1'] = $room['image1']; // Giữ lại ảnh cũ
        }

        for ($i = 2; $i <= 4; $i++) {
            if (!empty($_FILES["image$i"]) && $_FILES["image$i"]['error'] == 0) {
                $data["image$i"] = $this->uploadFile($_FILES["image$i"], 'rooms');
            } else {
                $data["image$i"] = $room["image$i"]; // Giữ lại ảnh cũ
            }
        }

        $this->rooms->update($id, $data);
        redirect('/admin/rooms');
    }

    public function show($id)
    {
        $rooms = $this->rooms->find($id);
        $homestays = $this->homestays->findAll();
        $promotions = $this->promotions->getRoomPromotions($id);
        return view('admin.rooms.detail', compact('rooms', 'homestays', 'promotions'));
    }
}
