@extends('layout.layout')

@section('title', 'Giỏ Hàng')

@section('styles')
<style>
    /* Breadcrumb */
    .breadcrumb {
        display: flex;
        padding: 10px 0;
        font-size: 12px;
        color: #666;
        flex-wrap: wrap;
    }

    .breadcrumb a {
        color: #0770cd;
        text-decoration: none;
    }

    .breadcrumb span {
        margin: 0 8px;
    }

    /* Main content layout */
    .main-grid {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
    }

    .content-main {
        flex: 1;
        min-width: 0;
        padding: 0 15px;
    }

    /* Cart header */
    .cart-header {
        padding: 15px 0;
        border-bottom: 2px solid #e0e0e0;
        margin-bottom: 20px;
    }

    .cart-title {
        font-size: 24px;
        font-weight: 700;
        color: #333;
        margin: 0;
    }

    /* Cart items */
    .cart-item {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin-bottom: 15px;
        overflow: hidden;
    }

    .cart-item-header {
        background-color: #f5f5f5;
        padding: 12px 15px;
        font-weight: 600;
        font-size: 16px;
        color: #333;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .remove-item {
        color: #ff5e1f;
        font-size: 14px;
        cursor: pointer;
        text-decoration: none;
    }

    .cart-item-content {
        padding: 15px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }

    .cart-item-image {
        width: 120px;
        height: 80px;
        overflow: hidden;
        border-radius: 4px;
        margin-right: 20px;
    }

    .cart-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cart-item-details {
        flex: 1;
        min-width: 250px;
        padding-right: 20px;
    }

    .cart-item-name {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .cart-item-info {
        font-size: 13px;
        color: #666;
        margin-bottom: 5px;
    }

    .cart-item-dates {
        font-size: 13px;
        color: #333;
        margin-bottom: 5px;
    }

    .cart-item-pricing {
        width: 180px;
        text-align: right;
    }

    .cart-item-price {
        font-size: 18px;
        font-weight: 700;
        color: #ff5e1f;
        margin-bottom: 5px;
    }

    .cart-item-unit {
        font-size: 12px;
        color: #666;
    }

    /* Summary section */
    .cart-summary {
        background-color: #f5f5f5;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 14px;
        color: #333;
    }

    .summary-label {
        font-weight: 600;
    }

    .summary-value {
        color: #ff5e1f;
        font-weight: 600;
    }

    .summary-total {
        font-size: 18px;
        font-weight: 700;
        border-top: 1px solid #e0e0e0;
        padding-top: 10px;
        margin-top: 10px;
    }

    .checkout-button {
        background-color: #ff5e1f;
        color: white;
        padding: 12px 20px;
        font-weight: 600;
        font-size: 14px;
        border-radius: 4px;
        text-decoration: none;
        display: block;
        text-align: center;
        margin-top: 20px;
    }

    /* Empty cart */
    .empty-cart {
        text-align: center;
        padding: 50px 0;
        color: #666;
    }

    .empty-cart a {
        display: inline-block;
        background: #0770cd;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 600;
        margin-top: 20px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .cart-item-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .cart-item-image {
            width: 100%;
            height: 150px;
            margin-right: 0;
            margin-bottom: 15px;
        }

        .cart-item-details {
            width: 100%;
            padding-right: 0;
            margin-bottom: 15px;
        }

        .cart-item-pricing {
            width: 100%;
            text-align: left;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ '/' }}">Trang chủ</a>
        <span>/</span>
        <span>Giỏ hàng</span>
    </div>

    <div class="main-grid">
        <div class="content-main">
            <!-- Cart header -->
            <div class="cart-header">
                <h1 class="cart-title">Giỏ Hàng</h1>
            </div>

            @if(isset($cart) && count($cart) > 0)
                <!-- Cart items -->
                @foreach($cart as $item)
                <div class="cart-item">
                    <div class="cart-item-header">
                        <span>{{ $item['homestay_name'] }}</span>
                        <a href="#" class="remove-item">Xóa</a>
                    </div>
                    <div class="cart-item-content">
                        <div class="cart-item-image">
                            <img src="{{ file_url($item['room_image']) }}" alt="{{ $item['room_name'] }}">
                        </div>
                        <div class="cart-item-details">
                            <div class="cart-item-name">{{ $item['room_name'] }}</div>
                            <div class="cart-item-info">Sức chứa: {{ $item['capacity'] }} khách</div>
                            <div class="cart-item-dates">
                                Ngày nhận phòng: {{ $item['check_in'] }} - Ngày trả phòng: {{ $item['check_out'] }}
                            </div>
                        </div>
                        <div class="cart-item-pricing">
                            <div class="cart-item-price">{{ number_format($item['price'], 0, ',', '.') }} VND</div>
                            <div class="cart-item-unit">/ {{ $item['nights'] }} đêm</div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Cart summary -->
                <div class="cart-summary">
                    <div class="summary-row">
                        <span class="summary-label">Tổng tiền phòng</span>
                        <span class="summary-value">{{ number_format($cart_total, 0, ',', '.') }} VND</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">Thuế và phí</span>
                        <span class="summary-value">Đã bao gồm</span>
                    </div>
                    <div class="summary-row summary-total">
                        <span class="summary-label">Tổng cộng</span>
                        <span class="summary-value">{{ number_format($cart_total, 0, ',', '.') }} VND</span>
                    </div>
                    <a href="{{ '/checkout' }}" class="checkout-button">Thanh toán</a>
                </div>
            @else
                <!-- Empty cart -->
                <div class="empty-cart">
                    <h2>Giỏ hàng của bạn đang trống</h2>
                    <p>Thêm phòng vào giỏ hàng để tiếp tục đặt chỗ!</p>
                    <a href="{{ '/' }}">Quay lại trang chủ</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const removeButtons = document.querySelectorAll('.remove-item');
        
        removeButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Bạn có chắc muốn xóa mục này khỏi giỏ hàng?')) {
                    // Logic xóa mục khỏi giỏ hàng (cần xử lý phía backend)
                    this.closest('.cart-item').remove();
                    // Cập nhật lại tổng tiền nếu cần
                }
            });
        });
    });
</script>
@endsection