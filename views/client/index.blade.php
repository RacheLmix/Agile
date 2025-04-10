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
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
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
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        overflow: hidden;
        position: relative;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .homestay-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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

    .homestay-tag.highlight {
        background-color: #0070cc;
        color: white;
    }
</style>
@endsection

@section('content')
<div class="main-container">
    <!-- Filter Sidebar -->
    <div class="filter-sidebar">
        <form action="/" method="GET" id="filter-form">
            <!-- Search Keyword -->
            <div class="filter-card">
                <div class="filter-header">
                    Tìm kiếm
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="filter-body">
                    <input type="text" name="keyword" placeholder="Tên homestay..." value="{{ $keyword ?? '' }}" style="width: 100%; padding: 6px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
            </div>

            <!-- Location Filter -->
            <div class="filter-card">
                <div class="filter-header">
                    Vị trí
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="filter-body">
                    <input type="text" name="location" placeholder="Nhập vị trí..." value="{{ $location ?? '' }}" style="width: 100%; padding: 6px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
            </div>

            <!-- Category Filter -->
            <div class="filter-card">
                <div class="filter-header">
                    Loại hình lưu trú
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="filter-body">
                    <select name="category_id" style="width: 100%; padding: 6px; border: 1px solid #ddd; border-radius: 4px;">
                        <option value="">Tất cả</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}" {{ ($category_id === $category['id']) ? 'selected' : '' }}>{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="filter-actions">
                <button type="button" class="clear-filters" onclick="window.location.href='/'">Xóa bộ lọc</button>
                <button type="submit" class="apply-filters">Áp dụng</button>
            </div>
        </form>
    </div>

    <!-- Homestay List -->
    <div class="homestay-list-container">
        <div class="homestay-list-header">
            <div class="result-count">Hà Nội - {{ is_countable($homestays) ? count($homestays) : 0 }} nơi lưu trú được tìm thấy</div>
            <div class="sort-container">
                <span class="sort-label">Xếp theo:</span>
                <select class="sort-select" onchange="this.form.submit()">
                    <option>Độ phổ biến</option>
                    <option>Giá: Thấp đến Cao</option>
                    <option>Giá: Cao đến Thấp</option>
                    <option>Đánh giá: Cao đến Thấp</option>
                </select>
            </div>
        </div>

        <!-- Homestay Cards -->
        <div class="homestay-list">
            @if($keyword || $location || $category_id)
                <div style="margin-bottom: 16px; padding: 10px; background: #f0f8ff; border-radius: 4px; color: #0070cc;">
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
                                <span class="homestay-tag"><i class="fas fa-tag"></i>{{ $homestay['category_name'] ?? 'Nhà nghỉ Homestay' }}</span>
                                <span class="homestay-tag {{ $location && $homestay['location'] === $location ? 'highlight' : '' }}">
                                    <i class="fas fa-map-marker-alt"></i>{{ $homestay['location'] }}
                                </span>
                                <span class="homestay-tag"><i class="fas fa-user"></i>{{ $homestay['host_name'] ?? 'Chủ nhà' }}</span>
                            </div>
                            <p class="location-info">
                                <i class="fas fa-comment"></i>
                                <span>{{ $homestay['description'] ?? 'Không có mô tả' }}</span>
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <div style="text-align: center; padding: 30px;">
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
<script>
    // Toggle filter sections
    document.querySelectorAll('.filter-header').forEach(header => {
        header.addEventListener('click', () => {
            const body = header.nextElementSibling;
            const icon = header.querySelector('i');
            body.style.display = body.style.display === 'none' ? 'block' : 'none';
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
        });
    });

    // Preserve form values on page refresh
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('filter-form');
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const url = new URL(window.location.href);
            url.search = new URLSearchParams(formData).toString();
            window.location.href = url.toString();
        });
    });
</script>
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