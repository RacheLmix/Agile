@extends('layout.layout')

@section('title', 'Xác nhận đặt phòng thành công')

@section('styles')
<style>
    .success-container {
        max-width: 800px;
        margin: 30px auto;
        padding: 25px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .success-container h2 {
        color: #28a745;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .success-details {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 6px;
        margin-bottom: 20px;
        text-align: left;
    }

    .success-details h3 {
        margin-top: 0;
        margin-bottom: 15px;
        color: #333;
        font-size: 18px;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 15px;
    }

    .detail-item span:first-child {
        font-weight: 600;
        color: #555;
    }

    .detail-item span:last-child {
        color: #333;
    }

    .btn-home {
        background-color: #0770cd;
        color: white;
        border: none;
        padding: 14px 20px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s;
    }

    .btn-home:hover {
        background-color: #005bb5;
    }

    @media (max-width: 768px) {
        .success-container {
            margin: 15px;
            padding: 15px;
        }

        .success-details {
            padding: 15px;
        }

        .detail-item {
            flex-direction: column;
            gap: 5px;
        }

        .btn-home {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="success-container">
    <h2>Đặt phòng thành công!</h2>
    <p>Cảm ơn bạn đã đặt phòng tại <strong>{{ $homestay['name'] }}</strong>. Dưới đây là thông tin chi tiết về đặt phòng của bạn:</p>

    <div class="success-details">
        <h3>Thông tin đặt phòng</h3>
        <div class="detail-item">
            <span>Mã đặt phòng:</span>
            <span>{{ $booking['id'] }}</span>
        </div>
        <div class="detail-item">
            <span>Tên phòng:</span>
            <span>{{ $room['name'] }}</span>
        </div>
        <div class="detail-item">
            <span>Ngày nhận phòng:</span>
            <span>{{ $booking['check_in'] }}</span>
        </div>
        <div class="detail-item">
            <span>Ngày trả phòng:</span>
            <span>{{ $booking['check_out'] }}</span>
        </div>
        <div class="detail-item">
            <span>Số lượng khách:</span>
            <span>{{ $booking['guests'] }}</span>
        </div>
        <div class="detail-item">
            <span>Tiện ích đã chọn:</span>
            <span>{{ $booking['amenity'] ?? 'Không có tiện ích' }}</span>
        </div>
        <div class="detail-item">
            <span>Tổng tiền:</span>
            <span>{{ number_format($booking['total_price'], 0, ',', '.') }} VND</span>
        </div>
    </div>

    <a href="{{ '/' }}" class="btn-home">Quay lại trang chủ</a>
</div>
@endsection