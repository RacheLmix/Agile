<?php

namespace App\Controllers\admin;

use App\Controller;
use App\Models\Amenity;

class AmenityController extends Controller
{
    protected $amenities;

    public function __construct()
    {
        $this->amenities = new Amenity();
    }

    public function index()
    {
        $amenities = $this->amenities->findAllAmenities();
        view('admin.amenities.index', compact('amenities'));
    }

    public function create()
    {
        view('admin.amenities.create');
    }

    public function store()
    {
        $data = $_POST;
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->amenities->insert($data);
        redirect('/admin/amenities');
    }

    public function edit($id)
    {
        $amenity = $this->amenities->find($id);
        if (!$amenity) {
            // Xử lý nếu không tìm thấy
            redirect('/admin/amenities');
        }
        return view('admin.amenities.edit', compact('amenity'));
    }

    public function update($id)
    {
        $amenity = $this->amenities->find($id);
        if (!$amenity) {
            redirect('/admin/amenities');
        }

        $data = $_POST;
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->amenities->update($id, $data);
        redirect('/admin/amenities');
    }

    public function detail($id)
    {
        $amenity = $this->amenities->find($id);
        if (!$amenity) {
            redirect('/admin/amenities');
        }
        return view('admin.amenities.detail', compact('amenity'));
    }

    public function delete($id)
    {
        $amenity = $this->amenities->find($id);
        if ($amenity) {
            $this->amenities->delete($id);
        }
        redirect('/admin/amenities');
    }
}