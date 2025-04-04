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
        if(is_upload('image')){
            $data['image'] = $this->uploadFile($data['image'], 'homestays');
        }
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->homestays->insert($data);
        redirect('/admin/homestays');
    }
    public function update($id){
        $homestays = $this->homestays->find($id);
        $data = $_POST + $_FILES;
        if(is_upload('image')){
            $data['image'] = $this->uploadFile($data['image'], 'homestays');
            if($homestays['image'] && file_exists($homestays['image'])){
                unlink($homestays['image']);
            }
        }else{
            $data['image'] = $homestays['image'];
        }
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->homestays->update($id, $data);
        redirect('/admin/homestays');
    }
    public function edit($id){
        $categories = $this->categories->findAll();
        $homestays = $this->homestays->find($id);
        return view('admin.homestays.edit', compact('categories','homestays'));
    }
    public function detail($id){
        $categories = $this->categories->findAll();
        $homestays = $this->homestays->find($id);
        return view('admin.homestays.detail', compact('categories','homestays'));
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