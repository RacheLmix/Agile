@extends('layout.layout')

@section('title', 'Đặt Phòng Thành Công')

@section('styles')
<style>
    .success-container { text-align: center; padding: 50px 0; }
    .success-title { font-size: 24px; font-weight: 700; color: #333; margin-bottom: 20px; }
    .success-message { font-size: 16px; color: #666; margin-bottom: 20px; }
    .success-button { background-color: #0770cd; color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; font-weight: 600; display: inline-block; margin: 0 10px; }
    .cart-button { background-color: #ff5e1f; }
</style>
@endsection

@section('content')
<div class="container">
    <div class="success-container">
        <h1 class="success-title">Đặt Phòng Thành Công!</h1>
        <p class="success-message">Cảm ơn bạn đã đặt phòng tại {{ $homestay['name'] }}. Thông tin đặt phòng đã được gửi tới email {{ $booking['email'] }}.</p>
        <p class="success-message">Mã đặt phòng: <strong>{{ $booking['id'] }}</strong></p>
        <p class="success-message">Phòng: {{ $room['name'] }} | Tổng cộng: {{ number_format($booking['total_price'], 0, ',', '.') }} VND</p>
        <a href="{{ '/' }}" class="success-button">Quay lại trang chủ</a>
        <a href="{{ '/cart' }}" class="success-button cart-button">Xem giỏ hàng</a>
    </div>
</div>
@endsection