<?php

namespace App\Controllers\admin;

use App\Controller;
use App\Models\Homestay;
use App\Models\Category;

class HomestayController extends Controller{
    protected $homestays;
    protected $categories;
    public function __construct()
    {
        $this->homestays = new Homestay();
        $this->categories = new Category();
    }
    public function index(){
        $homestays = $this->homestays->findAllHomestaysWithDetails();
        view('admin.homestays.index', compact('homestays'));
    }
    public function create(){
        $categories = $this->categories->findAll();
        view('admin.homestays.create', compact('categories'));
    }
    public function store(){
        $data = $_POST + $_FILES;
        var_dump($data);
        if(is_upload('image')){
            $data['image'] = $this->uploadFile($data['image'], 'homestays');
        }
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->homestays->insert($data);
        redirect('/admin/homestays');
    }
}