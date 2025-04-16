@extends('layout.layout')
<style>
    .booking-container {
        max-width: 800px;
        margin: 30px auto;
        padding: 25px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    
    .booking-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }
    
    .form-input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        transition: border-color 0.3s;
    }
    
    .form-input:focus {
        border-color: #0770cd;
        outline: none;
        box-shadow: 0 0 0 2px rgba(7, 112, 205, 0.2);
    }
    
    .form-row {
        display: flex;
        gap: 20px;
    }
    
    .form-row .form-group {
        flex: 1;
    }
    
    .booking-summary {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 6px;
        margin-bottom: 20px;
    }
    
    .booking-summary h3 {
        margin-top: 0;
        margin-bottom: 15px;
        color: #333;
        font-size: 18px;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }
    
    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 15px;
    }
    
    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #eee;
        font-weight: 700;
        font-size: 18px;
        color: #333;
    }
    
    .btn-submit {
        background-color: #ff5e1f;
        color: white;
        border: none;
        padding: 14px 20px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    .btn-submit:hover {
        background-color: #e04e15;
    }
    
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        padding: 12px 15px;
        border-radius: 4px;
        margin-bottom: 20px;
        border: 1px solid #f5c6cb;
        font-size: 15px;
    }
    
    @media (max-width: 768px) {
        .booking-container {
            padding: 15px;
            margin: 15px;
        }
        
        .form-row {
            flex-direction: column;
            gap: 0;
        }
    }
</style>
@section('content')
<div class="booking-container">
    @if(isset($error))
    <div class="alert alert-danger">
        <strong>Lỗi!</strong> {{ $error }}
    </div>
    @endif
    
    <form action="/booking/store" method="POST" class="booking-form">
        <input type="hidden" name="homestay_id" value="{{ $booking['homestay_id'] }}"> <!-- Thêm homestay_id -->
        <input type="hidden" name="room_id" value="{{ $booking['room_id'] }}">
        <input type="hidden" name="check_in" value="{{ $booking['check_in'] }}">
        <input type="hidden" name="check_out" value="{{ $booking['check_out'] }}">
        <input type="hidden" name="guests" value="{{ $booking['guests'] }}">
        @if(isset($booking['amenities']) && is_array($booking['amenities']))
            @foreach($booking['amenities'] as $amenity)
                <input type="hidden" name="amenities[]" value="{{ $amenity }}">
            @endforeach
        @endif
        
        <div class="form-group">
            <label class="form-label">Họ và tên</label>
            <input type="text" class="form-input" name="full_name" value="{{ $_SESSION['user']['full_name'] ?? '' }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" class="form-input" name="email" value="{{ $_SESSION['user']['email'] ?? '' }}" required>
        </div>
        
        <div class="booking-summary">
            <h3>Thông tin đặt phòng</h3>
            <div class="summary-item">
                <span>Họ và tên:</span>
                <span id="summary-name">{{ $_SESSION['user']['full_name'] ?? '' }}</span>
            </div>
            <div class="summary-item">
                <span>Email:</span>
                <span id="summary-email">{{ $_SESSION['user']['email'] ?? '' }}</span>
            </div>
            <div class="summary-item">
                <span>Ngày nhận phòng:</span>
                <span>{{ $booking['check_in'] }}</span>
            </div>
            <div class="summary-item">
                <span>Ngày trả phòng:</span>
                <span>{{ $booking['check_out'] }}</span>
            </div>
            <div class="summary-item">
                <span>Số lượng khách:</span>
                <span>{{ $booking['guests'] }}</span>
            </div>
            <div class="summary-item">
                <span>Tên phòng:</span>
                <span>{{ $booking['room_name'] ?? 'Chưa chọn phòng' }}</span>
            </div>
            <div class="summary-item">
                <span>Tiện ích đã chọn:</span>
                <span>{{ isset($booking['amenities']) && is_array($booking['amenities']) ? implode(', ', $booking['amenities']) : 'Không có tiện ích' }}</span>
            </div>
            <div class="summary-item">
                <span>Số đêm:</span>
                <span>{{ $booking['nights'] }}</span>
            </div>
            <div class="summary-item">
                <span>Giá mỗi đêm:</span>
                @if(isset($booking['discount']) && $booking['discount'] > 0)
                    <span>
                        <span style="text-decoration: line-through; color: #999; font-size: 0.9em;">{{ number_format($booking['original_price'], 0, ',', '.') }} VND</span>
                        <span style="color: #ff5e1f; font-weight: bold;">{{ number_format($booking['price'], 0, ',', '.') }} VND</span>
                        <span style="background-color: #e53935; color: white; padding: 2px 6px; border-radius: 3px; font-size: 0.8em; margin-left: 5px;">-{{ $booking['discount'] }}%</span>
                    </span>
                @else
                    <span>{{ number_format($booking['price'], 0, ',', '.') }} VND</span>
                @endif
            </div>
            <div class="summary-total">
                <span>Tổng tiền:</span>
                <span>{{ number_format($booking['price'] * $booking['nights'], 0, ',', '.') }} VND</span>
            </div>
        </div>
        @if(isset($error))
            <button type="button" class="btn-submit" onclick="window.history.back();" style="background-color: #0770cd;">Quay lại chọn phòng khác</button>
        @else
            <button type="submit" class="btn-submit">Xác nhận đặt phòng</button>
        @endif
    </form>
</div>
@endsection