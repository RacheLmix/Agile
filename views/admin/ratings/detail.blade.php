@extends('admin.layout')

@section('title', 'Chi Tiết Đánh Giá')

@section('content')
<style>
    .detail-container {
        margin: 50px 0;
        padding: 20px;
    }

    .detail-card {
        background: #ffffff;
        border: 1px solid #ddd;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .detail-card h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    .detail-item {
        margin-bottom: 20px;
    }

    .detail-item label {
        display: block;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }

    .detail-item span {
        display: block;
        color: #555;
        font-size: 16px;
    }

    .rating-stars {
        color: #f39c12;
        font-size: 18px;
    }

    .back-link {
        display: inline-block;
        margin-bottom: 20px;
        color: #4e73df;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }
</style>

<div class="detail-container">
    <a href="/admin/ratings" class="back-link">← Quay lại danh sách</a>
    <div class="detail-card">
        <h2>Chi Tiết Đánh Giá</h2>

        <div class="detail-item">
            <label>ID Đánh Giá:</label>
            <span>{{ $rating['id'] }}</span>
        </div>

        <div class="detail-item">
            <label>Người Đánh Giá:</label>
            <span>{{ $rating['user_name'] ?? 'Không xác định' }}</span>
        </div>

        <div class="detail-item">
            <label>Homestay:</label>
            <span>{{ $rating['homestay_name'] ?? 'Không xác định' }}</span>
        </div>

        <div class="detail-item">
            <label>Điểm Đánh Giá:</label>
            <span class="rating-stars">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $rating['score'])
                        ★
                    @else
                        ☆
                    @endif
                @endfor
                ({{ $rating['score'] }}/5)
            </span>
        </div>

        <div class="detail-item">
            <label>Bình Luận:</label>
            <span>{{ $rating['content'] ?? 'Không có bình luận' }}</span>
        </div>

        <div class="detail-item">
            <label>Ngày Tạo:</label>
            <span>{{ $rating['created_at'] }}</span>
        </div>

        <div class="detail-item">
            <label>Ngày Cập Nhật:</label>
            <span>{{ $rating['updated_at'] ?? 'Chưa cập nhật' }}</span>
        </div>
    </div>
</div>
@endsection