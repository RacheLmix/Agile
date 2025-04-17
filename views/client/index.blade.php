@extends('layout.layout')

@section('title', 'Homestay Hà Nội tốt trên MộcHomestay tốt nhất')

@section('styles')
<style>
    /* Reset and Base Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: #f8fafc;
        color: #2d3748;
    }

    .main-container {
        max-width: 1300px;
        margin: 32px auto;
        padding: 0 16px;
    }

    /* Search Bar Container */
    .search-bar-container {
        display: flex;
        justify-content: center;
        margin-bottom: 32px;
        animation: fadeIn 0.6s ease-out;
    }

    .search-bar {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px;
        width: 100%;
        max-width: 900px;
        border: 1px solid #e2e8f0;
    }

    .search-field {
        flex: 1;
        min-width: 200px;
        position: relative;
    }

    .search-field i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #3182ce;
        font-size: 16px;
    }

    .search-field input,
    .search-field select {
        width: 100%;
        padding: 12px 12px 12px 40px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .search-field input:focus,
    .search-field select:focus {
        outline: none;
        border-color: #3182ce;
        box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.2);
    }

    .search-button {
        background: #ff6200;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        border: none;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .search-button:hover {
        background: #e55b00;
        transform: scale(1.02);
    }

    /* Homestay List */
    .homestay-list-container {
        animation: fadeIn 0.6s ease-out;
    }

    .homestay-list-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .result-count {
        font-size: 18px;
        font-weight: 600;
        color: #2d3748;
    }

    .sort-container {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .sort-label {
        font-size: 14px;
        color: #4a5568;
    }

    .sort-select {
        padding: 10px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        background: white;
        transition: all 0.3s ease;
    }

    .sort-select:hover,
    .sort-select:focus {
        border-color: #3182ce;
        box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.2);
    }

    .homestay-list {
        display: flex;
        flex-direction: column; /* Chuyển thành danh sách dọc */
        gap: 16px; /* Khoảng cách giữa các homestay card */
    }

    .homestay-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: flex; /* Sử dụng flex để hiển thị hình ảnh và nội dung cạnh nhau */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }

    .homestay-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.15);
    }

    .homestay-image {
        width: 280px; /* Kích thước hình ảnh giống trong hình */
        height: 200px;
        overflow: hidden;
        position: relative;
        flex-shrink: 0; /* Đảm bảo hình ảnh không bị co lại */
    }

    .homestay-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .homestay-card:hover .homestay-image img {
        transform: scale(1.08);
    }

    .homestay-details {
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        flex: 1; /* Chiếm toàn bộ không gian còn lại */
        position: relative;
    }

    .homestay-name {
        font-size: 16px;
        font-weight: 600;
        color: #2d3748;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .homestay-name:hover {
        color: #3182ce;
    }

    .rating-badge {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .rating-score {
        background: #3182ce;
        color: white;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    .rating-text {
        font-size: 12px;
        color: #718096;
    }

    .homestay-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .homestay-tag {
        background: #e6f0fa;
        color: #3182ce;
        font-size: 11px;
        padding: 4px 8px;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .homestay-tag.highlight {
        background: #3182ce;
        color: white;
    }

    .amenities-info {
        font-size: 12px;
        color: #4a5568;
        display: flex;
        align-items: flex-start;
        gap: 6px;
        max-width: 100%;
    }

    .amenities-info i {
        color: #3182ce;
        margin-top: 2px;
    }

    .amenities-info span {
        display: block;
        white-space: normal;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .price-container {
        position: absolute;
        top: 16px;
        right: 16px;
        text-align: right;
    }

    .price-label {
        font-size: 11px;
        color: #718096;
    }

    .price-value {
        font-size: 18px;
        font-weight: 700;
        color: #ed8936;
    }

    .price-night {
        font-size: 11px;
        color: #718096;
    }

    .booking-button {
        background: #3182ce;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        text-align: center;
        text-decoration: none;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.3s ease;
        align-self: flex-end; /* Đẩy nút sang bên phải */
        margin-top: auto; /* Đảm bảo nút ở dưới cùng */
    }

    .booking-button:hover {
        background: #2b6cb0;
        transform: scale(1.02);
    }

    .host-info {
        font-size: 12px;
        color: #4a5568;
        margin-top: 8px;
        line-height: 1.4;
    }

    /* Promo Banner */
    .promo-banner {
        margin: 32px 0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        animation: fadeInUp 0.6s ease-out;
    }

    .promo-banner img {
        width: 100%;
        height: auto;
        transition: transform 0.5s ease;
    }

    .promo-banner:hover img {
        transform: scale(1.05);
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .search-bar {
            flex-direction: column;
            gap: 12px;
            max-width: 100%;
        }

        .search-field {
            min-width: 100%;
        }

        .search-button {
            width: 100%;
        }

        .homestay-card {
            flex-direction: column; /* Chuyển thành dọc trên màn hình nhỏ */
        }

        .homestay-image {
            width: 100%;
            height: 180px;
        }

        .price-container {
            position: static;
            text-align: right;
            margin-top: 8px;
        }

        .booking-button {
            width: 100%;
            align-self: stretch;
        }
    }
</style>
@endsection

@section('content')
<div class="main-container">
    <!-- Search Bar Container -->
    <div class="search-bar-container">
        <form action="/" method="GET" class="search-bar">
            <!-- Search Keyword -->
            <div class="search-field">
                <i class="fas fa-search"></i>
                <input type="text" name="keyword" placeholder="Tên homestay..." value="{{ $keyword ?? '' }}">
            </div>

            <!-- Location Filter -->
            <div class="search-field">
                <i class="fas fa-map-marker-alt"></i>
                <input type="text" name="location" placeholder="Nhập vị trí..." value="{{ $location ?? '' }}">
            </div>

            <!-- Category Filter -->
            <div class="search-field">
                <i class="fas fa-tag"></i>
                <select name="category_id">
                    <option value="">Tất cả</option>
                    @foreach($categories as $category)
                        <option value="{{ $category['id'] }}" {{ ($category_id === $category['id']) ? 'selected' : '' }}>{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Search Button -->
            <button type="submit" class="search-button">
                <i class="fas fa-search"></i>
            </button>
            <a href="/">Xóa bộ lọc</a>
        </form>
    </div>

    <!-- Homestay List -->
    <div class="homestay-list-container">
        <div class="homestay-list-header">
            <div class="result-count">Hà Nội - {{ is_countable($homestays) ? count($homestays) : 0 }} nơi lưu trú được tìm thấy</div>
            <div class="sort-container">
                <span class="sort-label">Xếp theo:</span>
                <form method="GET" action="/" style="display: inline;">
                    <!-- Preserve existing filters -->
                    @if($keyword)
                    <input type="hidden" name="keyword" value="{{ $keyword }}">
                    @endif
                    @if($location)
                    <input type="hidden" name="location" value="{{ $location }}">
                    @endif
                    @if($category_id)
                    <input type="hidden" name="category_id" value="{{ $category_id }}">
                    @endif
                    
                    <select name="sort" class="sort-select" onchange="this.form.submit()">
                        <option value="popular" {{ ($sort ?? '') == 'popular' ? 'selected' : '' }}>Độ phổ biến</option>
                        <option value="price_asc" {{ ($sort ?? '') == 'price_asc' ? 'selected' : '' }}>Giá: Thấp đến Cao</option>
                        <option value="price_desc" {{ ($sort ?? '') == 'price_desc' ? 'selected' : '' }}>Giá: Cao đến Thấp</option>
                        <option value="rating_desc" {{ ($sort ?? '') == 'rating_desc' ? 'selected' : '' }}>Đánh giá: Cao đến Thấp</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Homestay Cards -->
        <div class="homestay-list">
            @if($keyword || $location || $category_id)
                <div style="margin-bottom: 16px; padding: 10px; background: #e6f0fa; border-radius: 4px; color: #3182ce;">
                    Kết quả tìm kiếm cho:
                    @if($keyword) <strong>Tên: {{ $keyword }}</strong> @endif
                    @if($location) <strong>Vị trí: {{ $location }}</strong> @endif
                    @if($category_id && $category = $categories[array_search($category_id, array_column($categories, 'id'))] ?? null)
                        <strong>Loại: {{ $category['name'] }}</strong>
                    @endif
                </div>
            @endif

            @if(is_array($homestays) && !empty($homestays))
                @foreach($homestays as $homestay)
                    <div class="homestay-card">
                        <div class="homestay-image">
                            <img src="{{ $homestay['image'] ?? 'default-image.jpg' }}" alt="{{ $homestay['name'] }}">
                        </div>
                        <div class="homestay-details">
                            <a href="{{ 'homestays/detail/' . $homestay['id'] }}" class="homestay-name">{{ $homestay['name'] }}</a>
                            <div class="rating-badge">
                                <span class="rating-score">{{ number_format($homestay['rating'] ?? 0, 1) }}</span>
                                <span class="rating-text">
                                    @if(($homestay['rating'] ?? 0) >= 9) Tuyệt hảo
                                    @elseif(($homestay['rating'] ?? 0) >= 8) Ấn tượng
                                    @else Tiện lợi @endif
                                    <span class="rating-count">(0)</span>
                                </span>
                            </div>
                            <div class="homestay-tags">
                                <span class="homestay-tag highlight"><i class="fas fa-tag"></i> {{ $homestay['category_name'] ?? 'Nhà nghỉ Homestay' }}</span>
                                <span class="homestay-tag {{ $location && $homestay['location'] === $location ? 'highlight' : '' }}">
                                    <i class="fas fa-map-marker-alt"></i> {{ $homestay['location'] }}
                                </span>
                            </div>
                            <p class="amenities-info">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ $homestay['description'] ?? 'Không có mô tả' }}</span>
                            </p>
                            <div class="price-container">
                                <div class="price-label">Giá trung bình</div>
                                <div class="price-value">{{ number_format($homestay['price'] ?? 0) }} VND</div>
                                <div class="price-night">phòng/đêm</div>
                            </div>
                            <a href="{{ 'homestays/detail/' . $homestay['id'] }}" class="booking-button">Xem phòng trống</a>
                        </div>
                    </div>
                @endforeach
            @else
                <div style="text-align: center; padding: 40px; font-size: 16px; color: #718096;">
                    <p>Không tìm thấy homestay nào phù hợp với tiêu chí tìm kiếm.</p>
                </div>
            @endif

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
    // Smooth scroll to homestay list on search
    document.querySelector('.search-button').addEventListener('click', () => {
        document.querySelector('.homestay-list-container').scrollIntoView({ behavior: 'smooth' });
    });
</script>
@endsection