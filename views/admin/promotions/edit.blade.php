@extends('admin.layout')
@section('content')
<style>
    .form-container {
        margin: 50px auto;
        max-width: 800px;
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .form-title {
        color: #333;
        font-size: 24px;
        margin-bottom: 30px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #555;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #0064be;
        outline: none;
        box-shadow: 0 0 0 2px rgba(0,100,190,0.1);
    }

    select.form-control {
        height: 42px;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: #0064be;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056a4;
    }

    .btn-default {
        background-color: #f8f9fa;
        color: #333;
        border: 1px solid #ddd;
    }

    .btn-default:hover {
        background-color: #e9ecef;
    }

    .button-group {
        margin-top: 30px;
        display: flex;
        gap: 10px;
    }

    .date-inputs {
        display: flex;
        gap: 20px;
    }

    .date-inputs .form-group {
        flex: 1;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 500;
        margin-left: 10px;
    }

    .status-active {
        background-color: #e6f7ee;
        color: #00b74a;
    }

    .status-expired {
        background-color: #feeaec;
        color: #f44336;
    }

    .status-inactive {
        background-color: #f5f5f5;
        color: #666;
    }
</style>

<div class="form-container">
    <h2 class="form-title">
        Chỉnh sửa khuyến mãi
        <span class="status-badge status-{{ $promotion['status'] }}">
            @if($promotion['status'] === 'active')
                Đang áp dụng
            @elseif($promotion['status'] === 'expired')
                Đã hết hạn
            @else
                Không kích hoạt
            @endif
        </span>
    </h2>

    <form action="/admin/promotions/update/{{ $promotion['id'] }}" method="POST">
        <div class="form-group">
            <label>Phòng áp dụng</label>
            <select name="room_id" class="form-control" >
                @foreach($rooms as $room)
                    <option value="{{ $room['id'] }}" 
                            {{ $room['id'] == $promotion['room_id'] ? 'selected' : '' }}>
                        {{ $room['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tiêu đề khuyến mãi</label>
            <input type="text" 
                   name="title" 
                   class="form-control" 
                   value="{{ $promotion['title'] }}" 
                   >
        </div>

        <div class="form-group">
            <label>Mô tả</label>
            <textarea name="description" 
                      class="form-control" 
                      rows="3">{{ $promotion['description'] }}</textarea>
        </div>

        <div class="form-group">
            <label>Phần trăm giảm giá (%)</label>
            <input type="number" 
                   name="discount_percent" 
                   class="form-control" 
                   value="{{ number_format($promotion['discount_percent'], 2, '.', '') }}"
                   min="0" 
                   max="100" 
                   step="0.01" 
                   >
        </div>

        <div class="date-inputs">
            <div class="form-group">
                <label>Ngày bắt đầu</label>
                <input type="date" 
                       name="start_date" 
                       class="form-control" 
                       value="{{ $promotion['start_date'] }}" 
                       >
            </div>

            <div class="form-group">
                <label>Ngày kết thúc</label>
                <input type="date" 
                       name="end_date" 
                       class="form-control" 
                       value="{{ $promotion['end_date'] }}" 
                       >
            </div>
        </div>

        <div class="form-group">
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="active" {{ $promotion['status'] == 'active' ? 'selected' : '' }}>
                    Kích hoạt
                </option>
                <option value="inactive" {{ $promotion['status'] == 'inactive' ? 'selected' : '' }}>
                    Không kích hoạt
                </option>
                <option value="expired" {{ $promotion['status'] == 'expired' ? 'selected' : '' }}>
                    Đã hết hạn
                </option>
            </select>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary" id="submitBtn">Cập nhật</button>
            <a href="/admin/promotions" class="btn btn-default">Hủy</a>
        </div>
    </form>
</div>

<script>
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Get form values
    const title = document.querySelector('input[name="title"]').value.trim();
    const discountPercent = document.querySelector('input[name="discount_percent"]').value;
    const startDate = new Date(document.querySelector('input[name="start_date"]').value);
    const endDate = new Date(document.querySelector('input[name="end_date"]').value);
    
    // Validate form
    let isValid = true;
    let errorMessage = '';
    
    if (title.length < 5) {
        errorMessage = 'Tiêu đề khuyến mãi phải có ít nhất 5 ký tự';
        isValid = false;
    } else if (discountPercent <= 0 || discountPercent > 100) {
        errorMessage = 'Phần trăm giảm giá phải lớn hơn 0 và nhỏ hơn hoặc bằng 100';
        isValid = false;
    } else if (isNaN(startDate.getTime())) {
        errorMessage = 'Vui lòng chọn ngày bắt đầu';
        isValid = false;
    } else if (isNaN(endDate.getTime())) {
        errorMessage = 'Vui lòng chọn ngày kết thúc';
        isValid = false;
    } else if (endDate <= startDate) {
        errorMessage = 'Ngày kết thúc phải sau ngày bắt đầu';
        isValid = false;
    }
    
    if (!isValid) {
        alert(errorMessage);
        return false;
    }
    
    // If validation passes, submit the form
    const submitBtn = document.querySelector('button[type="submit"]');
    submitBtn.textContent = 'Đang xử lý...';
    submitBtn.disabled = true;
    this.submit();
});
</script>
@endsection
