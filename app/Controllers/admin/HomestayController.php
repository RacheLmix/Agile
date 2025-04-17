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
        $amenities = $this->homestays->getAllAmenities(); // Lấy tất cả tiện ích
        view('admin.homestays.create', compact('categories', 'amenities'));
    }

    public function store()
    {
        $data = $_POST + $_FILES;

        // Manual validation
        if (empty($data['name'])) {
            $_SESSION['error'] = 'Vui lòng nhập tên homestay';
            $_SESSION['old'] = $_POST;
            redirect('/admin/homestays/create');
        }
        $existingHomestay = $this->homestays->findByName($data['name']);
        if ($existingHomestay) {
            $_SESSION['error'] = 'Tên homestay đã tồn tại. Vui lòng chọn tên khác.';
            $_SESSION['old'] = $_POST;
            redirect('/admin/homestays/create');
        }
        if (empty($data['location'])) {
            $_SESSION['error'] = 'Vui lòng nhập địa điểm';
            $_SESSION['old'] = $_POST;
            redirect('/admin/homestays/create');
        }
        if (empty($data['address'])) {
            $_SESSION['error'] = 'Vui lòng nhập địa chỉ';
            $_SESSION['old'] = $_POST;
            redirect('/admin/homestays/create');
        }
        if (empty($data['city'])) {
            $_SESSION['error'] = 'Vui lòng nhập thành phố';
            $_SESSION['old'] = $_POST;
            redirect('/admin/homestays/create');
        }
        if (empty($data['country'])) {
            $_SESSION['error'] = 'Vui lòng nhập quốc gia';
            $_SESSION['old'] = $_POST;
            redirect('/admin/homestays/create');
        }
        if (empty($data['price']) || !is_numeric($data['price']) || $data['price'] < 0) {
            $_SESSION['error'] = 'Vui lòng nhập giá hợp lệ (số không âm)';
            $_SESSION['old'] = $_POST;
            redirect('/admin/homestays/create');
        }
        if (empty($data['description'])) {
            $_SESSION['error'] = 'Vui lòng nhập mô tả';
            $_SESSION['old'] = $_POST;
            redirect('/admin/homestays/create');
        }
        if (empty($data['category_id']) || !$this->categories->find($data['category_id'])) {
            $_SESSION['error'] = 'Vui lòng chọn danh mục hợp lệ';
            $_SESSION['old'] = $_POST;
            redirect('/admin/homestays/create');
        }
        if (empty($data['status']) || !in_array($data['status'], ['active', 'inactive', 'pending', 'blocked'])) {
            $_SESSION['error'] = 'Vui lòng chọn trạng thái hợp lệ';
            $_SESSION['old'] = $_POST;
            redirect('/admin/homestays/create');
        }
        if (!empty($data['image']['name'])) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!in_array($data['image']['type'], $allowedTypes)) {
                $_SESSION['error'] = 'Hình ảnh phải có định dạng JPEG, PNG, JPG hoặc GIF';
                $_SESSION['old'] = $_POST;
                redirect('/admin/homestays/create');
            }
            if ($data['image']['size'] > 2 * 1024 * 1024) {
                $_SESSION['error'] = 'Hình ảnh không được vượt quá 2MB';
                $_SESSION['old'] = $_POST;
                redirect('/admin/homestays/create');
            }
        }

        if (is_upload('image')) {
            $data['image'] = $this->uploadFile($data['image'], 'homestays');
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        $amenities = $data['amenities'] ?? []; // Lấy danh sách tiện ích được chọn
        unset($data['amenities']); // Xóa amenities khỏi dữ liệu trước khi insert homestay

        // Lưu homestay và lấy ID
        $homestayId = $this->homestays->insert($data);

        // Lưu tiện ích vào bảng homestay_amenities
        if (!empty($amenities)) {
            foreach ($amenities as $amenityId) {
                $this->homestays->addAmenity($homestayId, $amenityId);
            }
        }

        redirect('/admin/homestays');
    }

    public function update($id)
    {
        $homestays = $this->homestays->find($id);
        $data = $_POST + $_FILES;

        // Manual validation
        if (empty($data['name'])) {
            $_SESSION['error'] = 'Vui lòng nhập tên homestay';
            $_SESSION['old'] = $_POST;
            redirect("/admin/homestays/edit/$id");
        }
        $existingHomestay = $this->homestays->findByName($data['name']);
        if ($existingHomestay && $existingHomestay['id'] != $id) {
            $_SESSION['error'] = 'Tên homestay đã tồn tại. Vui lòng chọn tên khác.';
            $_SESSION['old'] = $_POST;
            redirect("/admin/homestays/edit/$id");
        }
        if (empty($data['location'])) {
            $_SESSION['error'] = 'Vui lòng nhập địa điểm';
            $_SESSION['old'] = $_POST;
            redirect("/admin/homestays/edit/$id");
        }
        if (empty($data['address'])) {
            $_SESSION['error'] = 'Vui lòng nhập địa chỉ';
            $_SESSION['old'] = $_POST;
            redirect("/admin/homestays/edit/$id");
        }
        if (empty($data['city'])) {
            $_SESSION['error'] = 'Vui lòng nhập thành phố';
            $_SESSION['old'] = $_POST;
            redirect("/admin/homestays/edit/$id");
        }
        if (empty($data['country'])) {
            $_SESSION['error'] = 'Vui lòng nhập quốc gia';
            $_SESSION['old'] = $_POST;
            redirect("/admin/homestays/edit/$id");
        }
        if (empty($data['price']) || !is_numeric($data['price']) || $data['price'] < 0) {
            $_SESSION['error'] = 'Vui lòng nhập giá hợp lệ (số không âm)';
            $_SESSION['old'] = $_POST;
            redirect("/admin/homestays/edit/$id");
        }
        if (empty($data['description'])) {
            $_SESSION['error'] = 'Vui lòng nhập mô tả';
            $_SESSION['old'] = $_POST;
            redirect("/admin/homestays/edit/$id");
        }
        if (empty($data['category_id']) || !$this->categories->find($data['category_id'])) {
            $_SESSION['error'] = 'Vui lòng chọn danh mục hợp lệ';
            $_SESSION['old'] = $_POST;
            redirect("/admin/homestays/edit/$id");
        }
        if (empty($data['status']) || !in_array($data['status'], ['active', 'inactive', 'pending', 'blocked'])) {
            $_SESSION['error'] = 'Vui lòng chọn trạng thái hợp lệ';
            $_SESSION['old'] = $_POST;
            redirect("/admin/homestays/edit/$id");
        }
        if (!empty($data['image']['name'])) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!in_array($data['image']['type'], $allowedTypes)) {
                $_SESSION['error'] = 'Hình ảnh phải có định dạng JPEG, PNG, JPG hoặc GIF';
                $_SESSION['old'] = $_POST;
                redirect("/admin/homestays/edit/$id");
            }
            if ($data['image']['size'] > 2 * 1024 * 1024) {
                $_SESSION['error'] = 'Hình ảnh không được vượt quá 2MB';
                $_SESSION['old'] = $_POST;
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

        $amenities = $data['amenities'] ?? []; // Lấy danh sách tiện ích được chọn
        unset($data['amenities']); // Xóa amenities khỏi dữ liệu trước khi update homestay

        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->homestays->update($id, $data);

        // Xóa các tiện ích cũ của homestay
        $this->homestays->deleteAmenities($id);

        // Thêm lại các tiện ích mới
        if (!empty($amenities)) {
            foreach ($amenities as $amenityId) {
                $this->homestays->addAmenity($id, $amenityId);
            }
        }

        redirect('/admin/homestays');
    }

    public function edit($id)
    {
        $categories = $this->categories->findAll();
        $homestays = $this->homestays->find($id);
        $amenities = $this->homestays->getAllAmenities(); // Lấy tất cả tiện ích
        $selectedAmenities = $this->homestays->getAmenities($id); // Lấy tiện ích đã chọn của homestay
        return view('admin.homestays.edit', compact('categories', 'homestays', 'amenities', 'selectedAmenities'));
    }

    public function detail($id)
    {
        $categories = $this->categories->findAll();
        $homestays = $this->homestays->findHomestayWithDetails($id);
        $amenities = $this->homestays->getAmenities($id); // Lấy tiện ích của homestay
        return view('admin.homestays.detail', compact('categories', 'homestays', 'amenities'));
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