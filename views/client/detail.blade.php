@extends('layout.layout')

@section('title', isset($homestay) ? $homestay['name'] . ' - MộcHomestay' : 'Chi tiết Homestay')

@section('styles')
<style>
    /* Main container styles */
    .detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    /* Header section */
    .detail-header {
        margin-bottom: 24px;
    }
    
    .breadcrumb {
        display: flex;
        font-size: 13px;
        margin-bottom: 10px;
        color: #555;
    }
    
    .breadcrumb a {
        color: #0070cc;
        text-decoration: none;
        margin: 0 5px;
    }
    
    .breadcrumb span {
        margin: 0 5px;
    }
    
    .homestay-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }
    
    .homestay-type {
        font-size: 14px;
        color: #666;
        margin-bottom: 16px;
    }
    
    /* Rating section */
    .rating-container {
        display: flex;
        align-items: center;
        margin-bottom: 16px;
    }
    
    .rating-box {
        background: #0070cc;
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 24px;
        margin-right: 12px;
    }
    
    .rating-details {
        display: flex;
        flex-direction: column;
    }
    
    .rating-text {
        font-size: 16px;
        font-weight: 700;
    }
    
    .rating-count {
        font-size: 13px;
        color: #666;
    }
    
    /* Gallery section */
    .gallery-container {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        grid-template-rows: 1fr 1fr;
        gap: 8px;
        height: 400px;
        margin-bottom: 24px;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .gallery-main {
        grid-row: span 2;
        height: 100%;
    }
    
    .gallery-item {
        position: relative;
        overflow: hidden;
    }
    
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .gallery-item:hover img {
        transform: scale(1.05);
    }
    
    .view-all-photos {
        position: absolute;
        bottom: 20px;
        right: 20px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 13px;
        cursor: pointer;
        z-index: 10;
    }
    
    /* Navigation tabs */
    .detail-nav {
        display: flex;
        border-bottom: 1px solid #ddd;
        margin-bottom: 24px;
    }
    
    .nav-item {
        padding: 12px 24px;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        color: #555;
        border-bottom: 3px solid transparent;
    }
    
    .nav-item.active {
        color: #0070cc;
        border-bottom: 3px solid #0070cc;
    }
    
    /* Content layout */
    .detail-content {
        display: flex;
        gap: 24px;
    }
    
    .main-content {
        flex: 2;
    }
    
    .sidebar {
        flex: 1;
    }
    
    /* Content sections */
    .content-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        padding: 24px;
        margin-bottom: 24px;
    }
    
    .section-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 16px;
        color: #333;
    }
    
    .section-subtitle {
        font-size: 16px;
        font-weight: 600;
        margin: 16px 0 8px;
        color: #444;
    }
    
    /* Location section */
    .location-details {
        margin-top: 16px;
    }
    
    .address {
        font-size: 14px;
        color: #666;
        margin-bottom: 16px;
    }
    
    .map-container {
        height: 300px;
        background: #f5f5f5;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }
    
    /* Amenities section */
    .amenities-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
    
    .amenity-item {
        display: flex;
        align-items: center;
    }
    
    .amenity-item i {
        margin-right: 8px;
        color: #0070cc;
    }
    
    /* Reviews section */
    .review-summary {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .review-highlights {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .highlight-tag {
        background: #f0f8ff;
        color: #0070cc;
        padding: 5px 12px;
        border-radius: 16px;
        font-size: 13px;
    }
    
    .review-item {
        border-bottom: 1px solid #eee;
        padding: 16px 0;
    }
    
    .review-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    
    .reviewer-info {
        display: flex;
        align-items: center;
    }
    
    .reviewer-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 12px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #666;
    }
    
    .reviewer-name {
        font-weight: 500;
    }
    
    .review-date {
        font-size: 12px;
        color: #999;
    }
    
    .review-score {
        background: #0070cc;
        color: white;
        padding: 2px 8px;
        border-radius: 4px;
        font-weight: 600;
    }
    
    .review-text {
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 8px;
    }
    
    .review-helpful {
        font-size: 12px;
        color: #666;
        text-align: right;
    }
    
    /* Sidebar booking card */
    .booking-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        position: sticky;
        top: 20px;
    }
    
    .booking-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
    }
    
    .price-display {
        margin-bottom: 8px;
    }
    
    .price-value {
        font-size: 24px;
        font-weight: 700;
        color: #ff5e1f;
    }
    
    .price-unit {
        font-size: 14px;
        color: #666;
    }
    
    .booking-dates {
        padding: 20px;
        border-bottom: 1px solid #eee;
    }
    
    .date-inputs {
        display: flex;
        gap: 10px;
    }
    
    .date-field {
        flex: 1;
    }
    
    .date-label {
        font-size: 12px;
        color: #666;
        margin-bottom: 4px;
    }
    
    .date-input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    
    .booking-guests {
        padding: 20px;
        border-bottom: 1px solid #eee;
    }
    
    .guest-dropdown {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    
    .booking-cta {
        padding: 20px;
    }
    
    .book-now-btn {
        width: 100%;
        background: #ff5e1f;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s;
    }
    
    .book-now-btn:hover {
        background: #e04e10;
    }
    
    /* Policies section */
    .policy-list {
        list-style: none;
        padding: 0;
    }
    
    .policy-item {
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .policy-title {
        font-weight: 600;
        margin-bottom: 4px;
    }
    
    .policy-text {
        font-size: 14px;
        color: #666;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .detail-content {
            flex-direction: column-reverse;
        }
        
        .gallery-container {
            height: 300px;
        }
    }
    
    @media (max-width: 768px) {
        .gallery-container {
            grid-template-columns: 1fr;
            grid-template-rows: repeat(3, 1fr);
            height: auto;
        }
        
        .gallery-main {
            grid-row: span 1;
        }
        
        .gallery-item:nth-child(4),
        .gallery-item:nth-child(5) {
            display: none;
        }
        
        .amenities-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
@if(isset($homestay))
<div class="detail-container">
    <!-- Breadcrumb -->
    <div class="detail-header">
        <div class="breadcrumb">
            <a href="{{ url('/') }}">Trang chủ</a>
            <span>/</span>
            <a href="{{ url('/homestays') }}">Homestay</a>
            <span>/</span>
            <a href="{{ url('/homestays/vietnam') }}">Việt Nam</a>
            <span>/</span>
            <span>{{ $homestay['name'] }}</span>
        </div>
        
        <h1 class="homestay-title">{{ $homestay['name'] }}</h1>
        <div class="homestay-type">{{ $homestay['category_name'] ?? 'Nhà Nghỉ Homestay' }}</div>
        
        <!-- Rating display -->
        <div class="rating-container">
            <div class="rating-box">{{ number_format($homestay['rating'] ?? 0, 1) }}</div>
            <div class="rating-details">
                <div class="rating-text">
                    @if(($homestay['rating'] ?? 0) >= 9)
                        Tuyệt hảo
                    @elseif(($homestay['rating'] ?? 0) >= 8)
                        Ấn tượng
                    @elseif(($homestay['rating'] ?? 0) >= 7)
                        Tiện lợi
                    @else
                        Bình thường
                    @endif
                </div>
                <div class="rating-count">80 đánh giá</div>
            </div>
        </div>
    </div>
    
    <!-- Gallery -->
    <div class="gallery-container">
        <div class="gallery-item gallery-main">
            <img src="{{ $homestay['image'] }}" alt="{{ $homestay['name'] }}" />
        </div>
        <div class="gallery-item">
            <img src="{{ $homestay['image'] }}" alt="{{ $homestay['name'] }}" />
        </div>
        <div class="gallery-item">
            <img src="{{ $homestay['image'] }}" alt="{{ $homestay['name'] }}" />
        </div>
        <div class="gallery-item">
            <img src="{{ $homestay['image'] }}" alt="{{ $homestay['name'] }}" />
        </div>
        <div class="gallery-item">
            <img src="{{ $homestay['image'] }}" alt="{{ $homestay['name'] }}" />
            <div class="view-all-photos">Xem tất cả hình ảnh</div>
        </div>
    </div>
    
    <!-- Navigation tabs -->
    <div class="detail-nav">
        <div class="nav-item active">Tổng quan</div>
        <div class="nav-item">Phòng</div>
        <div class="nav-item">Vị trí</div>
        <div class="nav-item">Tiện ích</div>
        <div class="nav-item">Chính sách</div>
        <div class="nav-item">Đánh giá</div>
    </div>
    
    <!-- Main content -->
    <div class="detail-content">
        <div class="main-content">
            <!-- Overview section -->
            <div class="content-section">
                <h2 class="section-title">Giới thiệu về {{ $homestay['name'] }}</h2>
                <div>
                    <h3 class="section-subtitle">Lịch sử hình thành {{ $homestay['name'] }}</h3>
                    <p>{{ $homestay['description'] }}</p>
                    
                    <h3 class="section-subtitle">Đặc trưng kiến trúc</h3>
                    <p>{{ $homestay['name'] }} hiện lên với phong cách thiết kế hiện đại kết hợp cùng sự ấm cúng của không gian gia đình, tạo nên một trải nghiệm lưu trú độc đáo và đáng nhớ. {{ $homestay['name'] }} đã khéo léo tận dụng ánh sáng tự nhiên qua các khung cửa sổ lớn, giúp không gian luôn tràn ngập ánh sáng và thông thoáng.</p>
                </div>
            </div>
            
            <!-- Location section -->
            <div class="content-section">
                <h2 class="section-title">Vị trí</h2>
                <div class="location-details">
                    <div class="address">{{ $homestay['address'] }}</div>
                    <div class="map-container">
                        <p>Bản đồ sẽ được hiển thị tại đây</p>
                    </div>
                    
                    <h3 class="section-subtitle">Xung quanh {{ $homestay['name'] }} có gì</h3>
                    <div class="amenities-grid">
                        <div class="amenity-item">
                            <i class="fas fa-utensils"></i>
                            <span>Nhà hàng (500m)</span>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-shopping-bag"></i>
                            <span>Chợ đêm (1km)</span>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-coffee"></i>
                            <span>Cà phê (300m)</span>
                        </div>
                        <div class="amenity-item">
                            <i class="fas fa-store"></i>
                            <span>Cửa hàng tiện lợi (200m)</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Amenities section -->
            <div class="content-section">
                <h2 class="section-title">Tiện ích chính</h2>
                <div class="amenities-grid">
                    <div class="amenity-item">
                        <i class="fas fa-snowflake"></i>
                        <span>Máy lạnh</span>
                    </div>
                    <div class="amenity-item">
                        <i class="fas fa-concierge-bell"></i>
                        <span>Lễ tân 24h</span>
                    </div>
                    <div class="amenity-item">
                        <i class="fas fa-elevator"></i>
                        <span>Thang máy</span>
                    </div>
                    <div class="amenity-item">
                        <i class="fas fa-wifi"></i>
                        <span>WiFi</span>
                    </div>
                    <div class="amenity-item">
                        <i class="fas fa-parking"></i>
                        <span>Bãi đỗ xe</span>
                    </div>
                    <div class="amenity-item">
                        <i class="fas fa-tv"></i>
                        <span>TV</span>
                    </div>
                </div>
            </div>
            
            <!-- Reviews section -->
            <div class="content-section">
                <h2 class="section-title">Đánh giá</h2>
                <div class="review-summary">
                    <div class="rating-box">{{ number_format($homestay['rating'] ?? 0, 1) }}</div>
                    <div class="rating-details">
                        <div class="rating-text">
                            @if(($homestay['rating'] ?? 0) >= 9)
                                Tuyệt hảo
                            @elseif(($homestay['rating'] ?? 0) >= 8)
                                Ấn tượng
                            @elseif(($homestay['rating'] ?? 0) >= 7)
                                Tiện lợi
                            @else
                                Bình thường
                            @endif
                        </div>
                        <div class="rating-count">80 đánh giá</div>
                    </div>
                </div>
                
                <div class="review-highlights">
                    <div class="highlight-tag">Khoảng Cách Đến Trung Tâm (11)</div>
                    <div class="highlight-tag">Nhân Viên Thân Thiện (10)</div>
                    <div class="highlight-tag">Khu Vực Xung Quanh (9)</div>
                    <div class="highlight-tag">Wifi (8)</div>
                </div>
                
                <!-- Review items -->
                <div class="review-list">
                    <div class="review-item">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">MT</div>
                                <div>
                                    <div class="reviewer-name">Mạc T.</div>
                                    <div class="review-date">Đánh giá cách đây 17 tuần</div>
                                </div>
                            </div>
                            <div class="review-score">9.7</div>
                        </div>
                        <div class="review-text">View xịn đét, phòng sạch sẽ, giá cả hợp lí 😘 ưng lém ạ</div>
                        <div class="review-helpful">2 người nghĩ đánh giá này hữu ích</div>
                    </div>
                    
                    <div class="review-item">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">T</div>
                                <div>
                                    <div class="reviewer-name">Trinh</div>
                                    <div class="review-date">Đánh giá cách đây 17 tuần</div>
                                </div>
                            </div>
                            <div class="review-score">9.4</div>
                        </div>
                        <div class="review-text">bác bảo vệ rất thoải mái vui tính, hỗ trợ mình rất nhiều lun, tuy ko có hình chụ phòng, nhưng ko gian oki lám</div>
                        <div class="review-helpful">2 người nghĩ đánh giá này hữu ích</div>
                    </div>
                </div>
            </div>
            
            <!-- Policies section -->
            <div class="content-section">
                <h2 class="section-title">Chính sách</h2>
                <ul class="policy-list">
                    <li class="policy-item">
                        <div class="policy-title">Nhận phòng & Trả phòng</div>
                        <div class="policy-text">Nhận phòng từ 14:00, Trả phòng trước 12:00</div>
                    </li>
                    <li class="policy-item">
                        <div class="policy-title">Chính sách hủy đặt phòng</div>
                        <div class="policy-text">Đặt phòng này không được hoàn tiền.</div>
                    </li>
                    <li class="policy-item">
                        <div class="policy-title">Trẻ em và giường phụ</div>
                        <div class="policy-text">Trẻ em dưới 5 tuổi có thể ở miễn phí. Trẻ trên 5 tuổi sẽ tính như người lớn.</div>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="booking-card">
                <div class="booking-header">
                    <div class="price-display">
                        <span class="price-value">{{ number_format($homestay['price'] ?? 500000, 0, ',', '.') }}</span>
                        <span class="price-unit"> VND / đêm</span>
                    </div>
                    <div>Giá đã bao gồm thuế và phí</div>
                </div>
                
                <div class="booking-dates">
                    <div class="date-inputs">
                        <div class="date-field">
                            <div class="date-label">Nhận phòng</div>
                            <input type="date" class="date-input" />
                        </div>
                        <div class="date-field">
                            <div class="date-label">Trả phòng</div>
                            <input type="date" class="date-input" />
                        </div>
                    </div>
                </div>
                
                <div class="booking-guests">
                    <div class="date-label">Khách</div>
                    <select class="guest-dropdown">
                        <option>1 Người lớn</option>
                        <option>2 Người lớn</option>
                        <option>3 Người lớn</option>
                        <option>4 Người lớn</option>
                    </select>
                </div>
                
                <div class="booking-cta">
                    <button class="book-now-btn">Đặt ngay</button>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="detail-container">
    <div style="text-align: center; padding: 100px 0;">
        <h2>Không tìm thấy thông tin homestay</h2>
        <p>Homestay này không tồn tại hoặc đã bị xóa</p>
        <a href="{{ url('/') }}" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background: #0070cc; color: white; text-decoration: none; border-radius: 4px;">Quay lại trang chủ</a>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    // Tab navigation
    document.querySelectorAll('.nav-item').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });
            tab.classList.add('active');
        });
    });
    
    // View all photos functionality
    document.querySelector('.view-all-photos')?.addEventListener('click', () => {
        alert('Chức năng xem tất cả hình ảnh sẽ được phát triển sau');
    });
</script>
@endsection
