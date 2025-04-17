<?php

namespace App\Controllers\admin;

use App\Controller;
use App\Models\Homestay;
use App\Models\Category;

class HomestayController extends Controller
{
    protected $homestays;
    protected $categories;

    public function __construct()
    {
        $this->homestays = new Homestay();
        $this->categories = new Category();
    }

    public function index()
    {
        $homestays = $this->homestays->findAllHomestaysWithDetails();
        view('admin.homestays.index', compact('homestays'));
    }

    public function create()
    {
        $categories = $this->categories->findAll();
        view('admin.homestays.create', compact('categories'));
    }

    public function store()
    {
        $data = $_POST + $_FILES;

        // Manual validation
        if (empty($data['name'])) {
            $_SESSION['error'] = 'Vui lòng nhập tên homestay';
            redirect('/admin/homestays/create');
        }
        if (empty($data['location'])) {
            $_SESSION['error'] = 'Vui lòng nhập địa điểm';
            redirect('/admin/homestays/create');
        }
        if (empty($data['address'])) {
            $_SESSION['error'] = 'Vui lòng nhập địa chỉ';
            redirect('/admin/homestays/create');
        }
        if (empty($data['price']) || !is_numeric($data['price']) || $data['price'] < 0) {
            $_SESSION['error'] = 'Vui lòng nhập giá hợp lệ (số không âm)';
            redirect('/admin/homestays/create');
        }
        if (empty($data['description'])) {
            $_SESSION['error'] = 'Vui lòng nhập mô tả';
            redirect('/admin/homestays/create');
        }
        if (empty($data['category_id']) || !$this->categories->find($data['category_id'])) {
            $_SESSION['error'] = 'Vui lòng chọn danh mục hợp lệ';
            redirect('/admin/homestays/create');
        }
        if (!empty($data['image']['name'])) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!in_array($data['image']['type'], $allowedTypes)) {
                $_SESSION['error'] = 'Hình ảnh phải có định dạng JPEG, PNG, JPG hoặc GIF';
                redirect('/admin/homestays/create');
            }
            if ($data['image']['size'] > 2 * 1024 * 1024) { // Max 2MB
                $_SESSION['error'] = 'Hình ảnh không được vượt quá 2MB';
                redirect('/admin/homestays/create');
            }
        }

        if (is_upload('image')) {
            $data['image'] = $this->uploadFile($data['image'], 'homestays');
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $this->homestays->insert($data);
        redirect('/admin/homestays');
    }

    public function update($id)
    {
        $homestays = $this->homestays->find($id);
        $data = $_POST + $_FILES;

        // Manual validation
        if (empty($data['name'])) {
            $_SESSION['error'] = 'Vui lòng nhập tên homestay';
            redirect("/admin/homestays/edit/$id");
        }
        if (empty($data['location'])) {
            $_SESSION['error'] = 'Vui lòng nhập địa điểm';
            redirect("/admin/homestays/edit/$id");
        }
        if (empty($data['address'])) {
            $_SESSION['error'] = 'Vui lòng nhập địa chỉ';
            redirect("/admin/homestays/edit/$id");
        }
        if (empty($data['price']) || !is_numeric($data['price']) || $data['price'] < 0) {
            $_SESSION['error'] = 'Vui lòng nhập giá hợp lệ (số không âm)';
            redirect("/admin/homestays/edit/$id");
        }
        if (empty($data['description'])) {
            $_SESSION['error'] = 'Vui lòng nhập mô tả';
            redirect("/admin/homestays/edit/$id");
        }
        if (empty($data['category_id']) || !$this->categories->find($data['category_id'])) {
            $_SESSION['error'] = 'Vui lòng chọn danh mục hợp lệ';
            redirect("/admin/homestays/edit/$id");
        }
        if (!empty($data['image']['name'])) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!in_array($data['image']['type'], $allowedTypes)) {
                $_SESSION['error'] = 'Hình ảnh phải có định dạng JPEG, PNG, JPG hoặc GIF';
                redirect("/admin/homestays/edit/$id");
            }
            if ($data['image']['size'] > 2 * 1024 * 1024) { // Max 2MB
                $_SESSION['error'] = 'Hình ảnh không được vượt quá 2MB';
                redirect("/admin/homestays/edit/$id");
            }
        }

        if (is_upload('image')) {
            $data['image'] = $this->uploadFile($data['image'], 'homestays');
            if ($homestays['image'] && file_exists($homestays['image'])) {
                unlink($homestays['image']);
            }
        } else {
            $data['image'] = $homestays['image'];
        }

        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->homestays->update($id, $data);
        redirect('/admin/homestays');
    }

    public function edit($id)
    {
        $categories = $this->categories->findAll();
        $homestays = $this->homestays->find($id);
        return view('admin.homestays.edit', compact('categories', 'homestays'));
    }

    public function detail($id)
    {
        $categories = $this->categories->findAll();
        $homestays = $this->homestays->find($id);
        return view('admin.homestays.detail', compact('categories', 'homestays'));
    }

    public function delete($id)
    {
        $homestay = $this->homestays->find($id);
        if (file_exists($homestay['image'])) {
            unlink($homestay['image']);
        }
        $this->homestays->delete($id);
        redirect('/admin/homestays');
    }
}