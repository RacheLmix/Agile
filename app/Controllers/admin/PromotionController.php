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
        
        // Validate data
        $errors = $this->validatePromotion($data);
        
        if (!empty($errors)) {
            // If there are errors, redirect back with error message
            // This assumes you have a flash message system
            $_SESSION['error'] = $errors[0];
            redirect('/admin/promotions/create');
            return;
        }
        
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->promotions->insert($data);
        $_SESSION['success'] = 'Khuyến mãi đã được tạo thành công';
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
        
        // Validate data
        $errors = $this->validatePromotion($data);
        
        if (!empty($errors)) {
            // If there are errors, redirect back with error message
            $_SESSION['error'] = $errors[0];
            redirect('/admin/promotions/edit/' . $id);
            return;
        }
        
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->promotions->update($id, $data);
        $_SESSION['success'] = 'Khuyến mãi đã được cập nhật thành công';
        redirect('/admin/promotions');
    }

    private function validatePromotion($data)
    {
        $errors = [];
        
        // Validate title
        if (empty($data['title']) || strlen($data['title']) < 5) {
            $errors[] = 'Tiêu đề khuyến mãi phải có ít nhất 5 ký tự';
        }
        
        // Validate discount percent
        if (!isset($data['discount_percent']) || 
            !is_numeric($data['discount_percent']) || 
            $data['discount_percent'] <= 0 || 
            $data['discount_percent'] > 100) {
            $errors[] = 'Phần trăm giảm giá phải lớn hơn 0 và nhỏ hơn hoặc bằng 100';
        }
        
        // Validate dates
        if (empty($data['start_date'])) {
            $errors[] = 'Vui lòng chọn ngày bắt đầu';
        }
        
        if (empty($data['end_date'])) {
            $errors[] = 'Vui lòng chọn ngày kết thúc';
        }
        
        if (!empty($data['start_date']) && !empty($data['end_date'])) {
            $startDate = strtotime($data['start_date']);
            $endDate = strtotime($data['end_date']);
            $today = strtotime(date('Y-m-d'));
            
            // For new promotions, start date should not be in the past
            if (!isset($data['id']) && $startDate < $today) {
                $errors[] = 'Ngày bắt đầu không thể là ngày trong quá khứ';
            }
            
            if ($endDate <= $startDate) {
                $errors[] = 'Ngày kết thúc phải sau ngày bắt đầu';
            }
        }
        
        return $errors;
    }

    public function delete($id)
    {
        $this->promotions->delete($id);
        redirect('/admin/promotions');
    }
}