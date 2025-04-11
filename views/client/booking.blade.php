@extends('layout.layout')

@section('title', 'Đặt Phòng')

@section('styles')
<style>
    .breadcrumb { display: flex; padding: 10px 0; font-size: 12px; color: #666; flex-wrap: wrap; }
    .breadcrumb a { color: #0770cd; text-decoration: none; }
    .breadcrumb span { margin: 0 8px; }
    .main-grid { display: flex; flex-wrap: wrap; margin: 0 -15px; }
    .content-main { flex: 1; min-width: 0; padding: 0 15px; }
    .booking-header { padding: 15px 0; border-bottom: 2px solid #e0e0e0; margin-bottom: 20px; }
    .booking-title { font-size: 24px; font-weight: 700; color: #333; margin: 0; }
    .booking-form { background-color: #f5f5f5; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
    .form-group { margin-bottom: 15px; }
    .form-label { font-size: 14px; font-weight: 600; color: #333; margin-bottom: 5px; display: block; }
    .form-input { width: 100%; padding: 10px; font-size: 14px; border: 1px solid #e0e0e0; border-radius: 4px; box-sizing: border-box; }
    .form-row { display: flex; gap: 15px; }
    .form-row .form-group { flex: 1; }
    .booking-summary { background-color: #e8f4f8; padding: 20px; border-radius: 8px; }
    .summary-item { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 14px; color: #333; }
    .summary-label { font-weight: 600; }
    .summary-value { color: #ff5e1f; font-weight: 600; }
    .summary-total { font-size: 18px; font-weight: 700; border-top: 1px solid #e0e0e0; padding-top: 10px; margin-top: 10px; }
    .confirm-button { background-color: #ff5e1f; color: white; padding: 12px 20px; font-weight: 600; font-size: 14px; border-radius: 4px; text-decoration: none; display: block; text-align: center; margin-top: 20px; border: none; cursor: pointer; }
    .error-message { color: #ff0000; font-size: 12px; margin-top: 5px; }
    @media (max-width: 768px) { .form-row { flex-direction: column; gap: 0; } }
</style>
@endsection

@section('content')
<div class="container">
    <div class="breadcrumb">
        <a href="{{ '/' }}">Trang chủ</a>
        <span>/</span>
        <a href="{{ '/homestays/detail/' . $homestay['id'] }}">Chi tiết homestay</a>
        <span>/</span>
        <span>Đặt phòng</span>
    </div>

    <div class="main-grid">
        <div class="content-main">
            <div class="booking-header">
                <h1 class="booking-title">Đặt Phòng tại {{ $homestay['name'] }}</h1>
            </div>

            @if(isset($booking))
                <form action="{{ '/booking/store' }}" method="POST" id="booking-form">
                    <input type="hidden" name="homestay_id" value="{{ $booking['homestay_id'] }}">
                    <input type="hidden" name="room_id" value="{{ $booking['room_id'] }}">
                    <div class="booking-form">
                        <h2 style="font-size: 18px; font-weight: 600; color: #333; margin-bottom: 20px;">Thông tin đặt phòng</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Ngày nhận phòng</label>
                                <input type="date" class="form-input" name="check_in" value="{{ $booking['check_in'] }}" id="check-in" required>
                                @if(isset($errors['check_in']))
                                    <span class="error-message">{{ $errors['check_in'] }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ngày trả phòng</label>
                                <input type="date" class="form-input" name="check_out" value="{{ $booking['check_out'] }}" id="check-out" required>
                                @if(isset($errors['check_out']))
                                    <span class="error-message">{{ $errors['check_out'] }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Số lượng khách</label>
                            <input type="number" class="form-input" name="guests" value="{{ $booking['guests'] }}" min="1" max="{{ $booking['capacity'] }}" required>
                            @if(isset($errors['guests']))
                                <span class="error-message">{{ $errors['guests'] }}</span>
                            @endif
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" class="form-input" name="name" placeholder="Nhập họ và tên" value="{{ $booking['name'] ?? '' }}" required>
                                @if(isset($errors['name']))
                                    <span class="error-message">{{ $errors['name'] }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-input" name="phone" placeholder="Nhập số điện thoại" value="{{ $booking['phone'] ?? '' }}" required>
                                @if(isset($errors['phone']))
                                    <span class="error-message">{{ $errors['phone'] }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-input" name="email" placeholder="Nhập email" value="{{ $booking['email'] ?? '' }}" required>
                            @if(isset($errors['email']))
                                <span class="error-message">{{ $errors['email'] }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Ghi chú (không bắt buộc)</label>
                            <textarea class="form-input" name="note" rows="3" placeholder="Nhập ghi chú nếu có">{{ $booking['note'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="booking-summary">
                        <h2 style="font-size: 18px; font-weight: 600; color: #333; margin-bottom: 20px;">Tóm tắt đặt phòng</h2>
                        <div class="summary-item">
                            <span class="summary-label">Tên phòng</span>
                            <span>{{ $booking['room_name'] ?? 'Chưa chọn phòng' }}</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Ngày nhận phòng</span>
                            <span id="summary-check-in">{{ $booking['check_in'] }}</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Ngày trả phòng</span>
                            <span id="summary-check-out">{{ $booking['check_out'] }}</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Số đêm</span>
                            <span id="summary-nights">{{ $booking['nights'] }}</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Số lượng khách</span>
                            <span>{{ $booking['guests'] }}</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Giá mỗi đêm</span>
                            <span>{{ number_format($booking['price'], 0, ',', '.') }} VND</span>
                        </div>
                        <div class="summary-item summary-total">
                            <span class="summary-label">Tổng cộng</span>
                            <span class="summary-value" id="summary-total">{{ number_format($booking['price'] * $booking['nights'], 0, ',', '.') }} VND</span>
                        </div>
                        <button type="submit" class="confirm-button">Xác nhận đặt phòng</button>
                    </div>
                </form>
            @else
                <div style="text-align: center; padding: 50px 0; color: #666;">
                    <h2>Không có thông tin đặt phòng</h2>
                    <p>Vui lòng quay lại trang chi tiết homestay để chọn phòng.</p>
                    <a href="{{ '/homestays/detail/' . $homestay['id'] }}" style="display: inline-block; background: #0770cd; color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; font-weight: 600;">Quay lại</a>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkInInput = document.getElementById('check-in');
        const checkOutInput = document.getElementById('check-out');
        const summaryNights = document.getElementById('summary-nights');
        const summaryTotal = document.getElementById('summary-total');
        const pricePerNight = {{ json_encode($booking['price'] ?? 0) }}; // Dùng json_encode để an toàn

        function calculateNights() {
            const checkIn = new Date(checkInInput.value);
            const checkOut = new Date(checkOutInput.value);
            const timeDiff = checkOut - checkIn;
            const nights = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
            return nights > 0 ? nights : 1;
        }

        function updateSummary() {
            const nights = calculateNights();
            summaryNights.textContent = nights;
            const total = pricePerNight * nights;
            summaryTotal.textContent = total.toLocaleString('vi-VN') + ' VND';
        }

        checkInInput.addEventListener('change', updateSummary);
        checkOutInput.addEventListener('change', updateSummary);

        // Cập nhật lần đầu khi tải trang
        updateSummary();
    }); // Đảm bảo đóng đúng ngoặc
</script>
@endsection