@extends('layout.layout')

@section('title', 'Homestay Hà Nội tốt trên MộcHomestay tốt nhất')

@section('styles')
<style>
    .main-container {
        max-width: 1200px;
        margin: 20px auto;
        display: flex;
        gap: 20px;
    }
    
    /* Filter Sidebar */
    .filter-sidebar {
        width: 250px;
        flex-shrink: 0;
    }
    
    .filter-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        margin-bottom: 16px;
        overflow: hidden;
    }
    
    .filter-header {
        padding: 12px 16px;
        font-weight: 600;
        font-size: 14px;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
    }
    
    .filter-header i {
        font-size: 12px;
        color: #666;
    }
    
    .filter-body {
        padding: 12px 16px;
    }
    
    .price-range-slider {
        width: 100%;
        margin: 10px 0;
    }
    
    .price-labels {
        display: flex;
        justify-content: space-between;
        margin-top: 5px;
        font-size: 12px;
        color: #666;
    }
    
    .filter-option {
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }
    
    .filter-option input[type="checkbox"] {
        margin-right: 8px;
    }
    
    .filter-option label {
        font-size: 13px;
        cursor: pointer;
        flex: 1;
    }
    
    .filter-option .count {
        font-size: 12px;
        color: #999;
    }
    
    .filter-actions {
        display: flex;
        justify-content: space-between;
        padding-top: 10px;
        margin-top: 10px;
        border-top: 1px solid #f0f0f0;
    }
    
    .clear-filters {
        background: none;
        border: none;
        color: #666;
        cursor: pointer;
        font-size: 13px;
        padding: 6px 12px;
    }
    
    .apply-filters {
        background: #0070cc;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 6px 15px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 500;
    }
    
    /* Homestay List */
    .homestay-list-container {
        flex: 1;
        width: 100%;
    }
    
    .homestay-list-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        width: 80%;
    }
    
    .result-count {
        font-size: 14px;
        font-weight: 500;
    }
    
    .sort-container {
        display: flex;
        align-items: center;
    }
    
    .sort-label {
        font-size: 13px;
        margin-right: 8px;
    }
    
    .sort-select {
        padding: 6px 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 13px;
    }
    
    .homestay-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
        width: 80%;
    }
    
    .homestay-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        display: flex;
        overflow: hidden;
        position: relative;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .homestay-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .homestay-image {
        width: 200px;
        height: 150px;
        flex-shrink: 0;
        overflow: hidden;
        position: relative;
    }
    
    .homestay-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .homestay-details {
        padding: 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .homestay-name {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 4px;
        text-decoration: none;
    }
    
    .homestay-name:hover {
        color: #0070cc;
    }
    
    .rating-badge {
        display: inline-flex;
        align-items: center;
        margin-right: 4px;
    }
    
    .rating-score {
        background: #0070cc;
        color: white;
        padding: 2px 4px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 13px;
    }
    
    .rating-text {
        font-size: 13px;
        font-weight: 500;
        margin-left: 4px;
    }
    
    .rating-count {
        color: #999;
        font-size: 12px;
        font-weight: normal;
    }
    
    .homestay-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 8px 0;
    }
    
    .homestay-tag {
        background-color: #f0f8ff;
        color: #0070cc;
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: 500;
        display: flex;
        align-items: center;
    }
    
    .homestay-tag i {
        margin-right: 4px;
        font-size: 10px;
    }
    
    .location-info {
        color: #666;
        font-size: 12px;
        display: flex;
        align-items: center;
        margin-top: 4px;
    }
    
    .location-info i {
        margin-right: 4px;
    }
    
    .price-container {
        text-align: right;
        margin-top: auto;
    }
    
    .price-label {
        font-size: 11px;
        color: #666;
    }
    
    .price-value {
        font-size: 20px;
        font-weight: 700;
        color: #ff5e1f;
    }
    
    .price-night {
        font-size: 12px;
        color: #666;
    }
    
    .booking-button {
        display: inline-block;
        background: #0070cc;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 8px 16px;
        font-size: 13px;
        font-weight: 500;
        margin-top: 10px;
        text-align: center;
        text-decoration: none;
    }
    
    .booking-button:hover {
        background: #005aa3;
    }
    
    /* Promotion Banner */
    .promo-banner {
        margin: 24px 0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .promo-banner img {
        width: 100%;
        height: auto;
        display: block;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .main-container {
            flex-direction: column;
        }
        
        .filter-sidebar {
            width: 100%;
        }
        
        .homestay-card {
            flex-direction: column;
        }
        
        .homestay-image {
            width: 100%;
        }
    }

    .homestay-details p {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
</style>
@endsection

@section('content')
<div class="main-container">
    <!-- Filter Sidebar -->
    <div class="filter-sidebar">
        <!-- Price Range Filter -->
        <div class="filter-card">
            <div class="filter-header">
                Khoảng giá
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="filter-body">
                <input type="range" class="price-range-slider" min="0" max="5000000" value="1000000">
                <div class="price-labels">
                    <span>0 VND</span>
                    <span>5.000.000 VND</span>
                </div>
                <div class="filter-actions">
                    <button class="clear-filters">Đặt lại</button>
                    <button class="apply-filters">Áp dụng</button>
                </div>
            </div>
        </div>
        
        <!-- Khuyến mãi Filter -->
        <div class="filter-card">
            <div class="filter-header">
                Khuyến mãi & Giảm giá
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="filter-body">
                <div class="filter-option">
                    <input type="checkbox" id="promo1">
                    <label for="promo1">Quyền lợi hấp dẫn</label>
                </div>
                <div class="filter-actions">
                    <button class="clear-filters">Đặt lại</button>
                    <button class="apply-filters">Áp dụng</button>
                </div>
            </div>
        </div>
        
        <!-- Star Rating Filter -->
        <div class="filter-card">
            <div class="filter-header">
                Đánh giá sao
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="filter-body">
                <div class="filter-option">
                    <input type="checkbox" id="star1">
                    <label for="star1">1</label>
                    <span class="count">(18)</span>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="star2">
                    <label for="star2">2</label>
                    <span class="count">(3)</span>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="star3">
                    <label for="star3">3</label>
                    <span class="count">(6)</span>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="star4">
                    <label for="star4">4</label>
                    <span class="count">(6)</span>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="star5">
                    <label for="star5">5</label>
                    <span class="count">(0)</span>
                </div>
                <div class="filter-actions">
                    <button class="clear-filters">Đặt lại</button>
                    <button class="apply-filters">Áp dụng</button>
                </div>
            </div>
        </div>
        
        <!-- Guest Rating Filter -->
        <div class="filter-card">
            <div class="filter-header">
                Đánh giá từ khách
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="filter-body">
                <div class="filter-option">
                    <input type="checkbox" id="rating7">
                    <label for="rating7">7+ Thuận tiện</label>
                    <span class="count">(12)</span>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="rating8">
                    <label for="rating8">8+ Ấn tượng</label>
                    <span class="count">(8)</span>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="rating9">
                    <label for="rating9">9+ Tuyệt hảo</label>
                    <span class="count">(2)</span>
                </div>
                <div class="filter-actions">
                    <button class="clear-filters">Đặt lại</button>
                    <button class="apply-filters">Áp dụng</button>
                </div>
            </div>
        </div>
        
        <!-- Accommodation Type Filter -->
        <div class="filter-card">
            <div class="filter-header">
                Loại hình lưu trú
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="filter-body">
                <div class="filter-option">
                    <input type="checkbox" id="type1" checked>
                    <label for="type1">Homestay</label>
                    <span class="count">(33)</span>
                </div>
                <div class="filter-actions">
                    <button class="clear-filters">Đặt lại</button>
                    <button class="apply-filters">Áp dụng</button>
                </div>
            </div>
        </div>
        
        <!-- Popular Amenities Filter -->
        <div class="filter-card">
            <div class="filter-header">
                Tiện nghi phổ biến
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="filter-body">
                <div class="filter-option">
                    <input type="checkbox" id="amenity1">
                    <label for="amenity1">Dịch vụ giặt ủi</label>
                    <span class="count">(29)</span>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="amenity2">
                    <label for="amenity2">Có thể đến được</label>
                    <span class="count">(22)</span>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="amenity3">
                    <label for="amenity3">Khu vực hút thuốc</label>
                    <span class="count">(20)</span>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="amenity4">
                    <label for="amenity4">Quầy lễ tân</label>
                    <span class="count">(17)</span>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="amenity5">
                    <label for="amenity5">Đưa đón sân bay</label>
                    <span class="count">(14)</span>
                </div>
                <a href="#" style="font-size: 12px; color: #0070cc; display: block; margin-top: 8px;">Xem Tất cả</a>
                <div class="filter-actions">
                    <button class="clear-filters">Đặt lại</button>
                    <button class="apply-filters">Áp dụng</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Homestay List -->
    <div class="homestay-list-container">
        <div class="homestay-list-header">
            <div class="result-count">Hà Nội - {{ is_countable($homestays) ? count($homestays) : 0 }} nơi lưu trú được tìm thấy</div>
            <div class="sort-container">
                <span class="sort-label">Xếp theo:</span>
                <select class="sort-select">
                    <option>Độ phổ biến</option>
                    <option>Giá: Thấp đến Cao</option>
                    <option>Giá: Cao đến Thấp</option>
                    <option>Đánh giá: Cao đến Thấp</option>
                </select>
            </div>
        </div>
        
        <!-- Homestay Cards -->
        <div class="homestay-list">
            @if(is_array($homestays) && count($homestays) > 0)
                @foreach($homestays as $homestay)
                <!-- Homestay Item -->
                <div class="homestay-card">
                    <div class="homestay-image">    
                        <img src="{{ $homestay['image'] }}" alt="{{ $homestay['name'] }}">
                    </div>
                    <div class="homestay-details">
                        <a href="{{ '/homestays/detail/' . $homestay['id'] }}" class="homestay-name">{{ $homestay['name'] }}</a>
                        <div class="rating-badge">
                            <span class="rating-score">{{ number_format($homestay['rating'] ?? 0, 1) }}</span>
                            <span class="rating-text">
                                @if(($homestay['rating'] ?? 0) >= 9)
                                    Tuyệt hảo
                                @elseif(($homestay['rating'] ?? 0) >= 8)
                                    Ấn tượng
                                @else
                                    Tiện lợi
                                @endif
                                <span class="rating-count">(0)</span>
                            </span>
                        </div>
                        <div class="homestay-tags">
                            <span class="homestay-tag"><i class="fas fa-tag"></i>{{ $homestay['category_name'] ?? 'Nhà nghỉ Homestay' }}</span>
                            <span class="homestay-tag"><i class="fas fa-map-marker-alt"></i>{{ $homestay['address'] }}</span>
                            <span class="homestay-tag"><i class="fas fa-user"></i>{{ $homestay['host_name'] ?? 'Chủ nhà' }}</span>
                        </div>
                        <p class="location-info">
                            <i class="fas fa-comment"></i>
                            <span>{{ $homestay['description'] }}</span>
                        </p>
                    </div>
                </div>
                @endforeach
            @else
                <div style="text-align: center; padding: 30px;">
                    <p>Không tìm thấy homestay nào.</p>
                </div>
            @endif

            <!-- Promotion Banner -->
            @if(is_array($homestays) && count($homestays) > 2)
            <div class="promo-banner">
                <img src="https://ik.imagekit.io/tvlk/image/imageResource/2024/03/14/1710408841489-2b1edaf8ca65c5ee339d1c19e6a0acaa.png?_src=imagekit&tr=q-80,w-1280" alt="Promotion">
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Toggle filter sections
    document.querySelectorAll('.filter-header').forEach(header => {
        header.addEventListener('click', () => {
            const body = header.nextElementSibling;
            const icon = header.querySelector('i');
            
            if (body.style.display === 'none') {
                body.style.display = 'block';
                icon.classList.replace('fa-chevron-down', 'fa-chevron-up');
            } else {
                body.style.display = 'none';
                icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
            }
        });
    });
</script>
@endsection