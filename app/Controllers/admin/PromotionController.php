<?php
namespace App\Controllers\admin;
use App\Controller;
use App\Models\Promotions;
use App\Models\Room;

class PromotionController extends Controller
{
    protected $promotions;
    protected $rooms;

    public function __construct()
    {
        $this->promotions = new Promotions();
        $this->rooms = new Room();
    }

    public function index()
    {
        $promotions = $this->promotions->findAll();
        view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $rooms = $this->rooms->findAll();
        view('admin.promotions.create', compact('rooms'));
    }

    public function store()
    {
        $data = $_POST;
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->promotions->insert($data);
        redirect('/admin/promotions');
    }

    public function edit($id)
    {
        $promotion = $this->promotions->find($id);
        $rooms = $this->rooms->findAll();
        view('admin.promotions.edit', compact('promotion', 'rooms'));
    }

    public function update($id)
    {
        $data = $_POST;
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->promotions->update($id, $data);
        redirect('/admin/promotions');
    }

    public function delete($id)
    {
        $this->promotions->delete($id);
        redirect('/admin/promotions');
    }
}