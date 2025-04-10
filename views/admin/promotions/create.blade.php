@extends('admin.layout')
@section('content')
<style>
    .container-fluid {
        padding: 30px;
    }

    .card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        margin-top: 20px;
        border: none;
    }

    .card-header {
        background: linear-gradient(135deg, #0064be, #1a8dff);
        color: white;
        padding: 20px;
        border-radius: 15px 15px 0 0;
        border-bottom: none;
    }

    .card-title {
        font-size: 20px;
        font-weight: 600;
        margin: 0;
    }

    .card-body {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #444;
        font-weight: 500;
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e1e1e1;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #0064be;
        box-shadow: 0 0 0 3px rgba(0, 100, 190, 0.1);
        outline: none;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23555' viewBox='0 0 16 16'%3E%3Cpath d='M8 11.5l-5-5h10l-5 5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        padding-right: 40px;
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    input[type="number"].form-control {
        padding-right: 10px;
    }

    input[type="date"].form-control {
        padding: 10px 15px;
    }

    .date-inputs {
        display: flex;
        gap: 20px;
    }

    .date-inputs .form-group {
        flex: 1;
    }

    .btn {
        padding: 12px 25px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0064be, #1a8dff);
        color: white;
        box-shadow: 0 4px 15px rgba(0, 100, 190, 0.2);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #005aa9, #0077e6);
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(0, 100, 190, 0.25);
    }

    .btn-default {
        background: #f8f9fa;
        color: #444;
        border: 1px solid #ddd;
        margin-left: 10px;
    }

    .btn-default:hover {
        background: #e9ecef;
    }

    .button-group {
        margin-top: 30px;
        display: flex;
        align-items: center;
    }

    /* Hiệu ứng loading cho button khi submit */
    .btn-primary.loading {
        position: relative;
        color: transparent;
    }

    .btn-primary.loading::after {
        content: "";
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin: -10px 0 0 -10px;
        border: 3px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container-fluid {
            padding: 15px;
        }

        .card-body {
            padding: 20px;
        }

        .date-inputs {
            flex-direction: column;
            gap: 0;
        }

        .btn {
            width: 100%;
            margin: 5px 0;
        }

        .button-group {
            flex-direction: column;
            gap: 10px;
        }

        .btn-default {
            margin-left: 0;
        }
    }
</style>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Thêm khuyến mãi mới</h3>
        </div>
        <div class="card-body">
            <form action="/admin/promotions/store" method="POST" id="promotionForm">
                <div class="form-group">
                    <label>Phòng áp dụng</label>
                    <select name="room_id" class="form-control" required>
                        @foreach($rooms as $room)
                            <option value="{{ $room['id'] }}">{{ $room['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Tiêu đề khuyến mãi</label>
                    <input type="text" name="title" class="form-control" 
                           placeholder="Nhập tiêu đề khuyến mãi" required>
                </div>

                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea name="description" class="form-control" 
                              placeholder="Nhập mô tả chi tiết về khuyến mãi" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label>Phần trăm giảm giá (%)</label>
                    <input type="number" name="discount_percent" class="form-control" 
                           placeholder="Nhập phần trăm giảm giá"
                           min="0" max="100" step="0.01" required>
                </div>

                <div class="date-inputs">
                    <div class="form-group">
                        <label>Ngày bắt đầu</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Ngày kết thúc</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>
                    <select name="status" class="form-control">
                        <option value="active">Kích hoạt</option>
                        <option value="inactive">Không kích hoạt</option>
                    </select>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary" id="submitBtn">Lưu khuyến mãi</button>
                    <a href="/admin/promotions" class="btn btn-default">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('promotionForm').addEventListener('submit', function() {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.classList.add('loading');
    submitBtn.disabled = true;
});
</script>
@endsection