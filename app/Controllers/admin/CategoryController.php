<?php

namespace App\Controllers\admin;

use App\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Homestay;
use App\Models\Room;
use App\Models\Category;

class CategoryController extends Controller{
    protected $category;
    protected $homestay;
    public function __construct()
    {
        $this->category = new Category();
        $this->homestay = new Homestay();
    }
    public function index(){
        $category = $this->category->findAll();
        return view("admin.categories.index",compact('category'));
    }
    public function create()
    {
        return view("admin.categories.create");
    }
    public function store()
    {
        $data = $_POST;
        if (empty($data['name']) || empty($data['description'])) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin';
            redirect('/admin/categories/create');
        }
        $this->category->insert($data);
        redirect('/admin/categories');
    }
    public function edit($id)
    {
        $category = $this->category->find($id);
        return view("admin.categories.edit", compact("category"));
    }
    public function update($id){
        $data = $_POST;

        if (empty($data['name']) || empty($data['description'])) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin';
            redirect("/admin/categories/edit/$id");
        }
        $this->category->update($id, $data);
        $_SESSION['success'] = 'Cập nhật danh mục thành công!';
        redirect('/admin/categories');
    }
    public function delete($id)
    {
        $homestayCount = $this->category->getallstus($id);  // Pass the category ID

        if ($homestayCount > 0) {
            $_SESSION['error'] = "Không thể xóa! Danh mục đang chứa {$homestayCount} homestay" . ($homestayCount > 1 ? 's' : '') . ".";
        } else {
            $this->category->delete($id);
            $_SESSION['success'] = "Xóa danh mục thành công.";
        }
        redirect('/admin/categories');
    }
    public function show($id){

    }
}