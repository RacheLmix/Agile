@extends('layout.layout')

@section('title', 'Chi tiết Homestay')

@section('styles')
<style>
    /* Keep original CSS with modifications for room section */
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

    .main-grid {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }

    .content-main {
        flex: 1;
        min-width: 0;
        padding: 0 10px;
    }

    .header-container {
        padding: 10px 15px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .homestay-info {
        flex: 1;
    }

    .homestay-title {
        font-size: 22px;
        font-weight: 700;
        margin: 0 0 6px;
        color: #222;
    }

    .homestay-type-rating {
        display: flex;
        align-items: center;
        margin-bottom: 6px;
    }

    .homestay-type {
        background-color: #e8f4f8;
        padding: 3px 6px;
        border-radius: 4px;
        color: #0064be;
        margin-right: 8px;
        font-size: 13px;
    }

    .star-rating {
        color: #ffc107;
        font-size: 16px;
    }

    .star-rating .fa-star-half-alt {
        color: #ffc107;
    }

    .pricing-container {
        text-align: right;
    }

    .price-label {
        font-size: 12px;
        color: #666;
        margin-bottom: 3px;
    }

    .price-value {
        font-size: 22px;
        font-weight: 700;
        color: #ff5e1f;
        margin-bottom: 8px;
    }

    .book-button {
        background-color: #ff5e1f;
        color: white;
        padding: 8px 15px;
        font-weight: 600;
        font-size: 13px;
        border-radius: 4px;
        text-decoration: none;
        display: inline-block;
        border: none;
        cursor: pointer;
    }

    .booking-form {
        background-color: #f5f5f5;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
    }

    .form-row {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .form-group {
        min-width: 100%;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #333;
        margin-bottom: 4px;
    }

    .form-input {
        width: 100%;
        padding: 6px;
        font-size: 13px;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
    }

    .urgency-alert {
        display: flex;
        align-items: center;
        background-color: #e8f4f8;
        padding: 10px 12px;
        border-radius: 6px;
        margin-bottom: 12px;
    }

    .clock-icon {
        background-color: #0064be;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
    }

    .clock-icon i {
        color: white;
        font-size: 14px;
    }

    .urgency-message {
        font-size: 13px;
        color: #333;
    }

    .urgency-highlight {
        color: #0064be;
        font-weight: 600;
    }

    .info-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-bottom: 15px;
    }

    .rating-display {
        display: flex;
        align-items: center;
        margin-bottom: 6px;
    }

    .rating-value {
        font-size: 22px;
        font-weight: 700;
        margin-right: 5px;
        color: #333;
    }

    .rating-scale {
        font-size: 13px;
        color: #666;
    }

    .rating-label {
        font-weight: 600;
        font-size: 15px;
        color: #0064be;
        margin-bottom: 6px;
    }

    .review-link {
        color: #0064be;
        text-decoration: none;
        display: flex;
        align-items: center;
        font-size: 13px;
        margin-bottom: 12px;
    }

    .review-link i {
        font-size: 11px;
        margin-left: 5px;
    }

    .review-heading {
        font-weight: 600;
        font-size: 13px;
        margin: 12px 0 8px;
    }

    .tag-container {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 6px;
    }

    .tag {
        background-color: #e8f5e9;
        color: #2e7d32;
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 11px;
    }

    .review-divider {
        height: 1px;
        background-color: #eee;
        margin: 10px 0;
    }

    .reviewer-name {
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 3px;
    }

    .review-score {
        color: #0064be;
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 3px;
    }

    .review-text {
        font-size: 12px;
        line-height: 1.4;
        color: #333;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .card-title {
        font-weight: 600;
        font-size: 15px;
        color: #333;
    }

    .card-link {
        color: #0064be;
        text-decoration: none;
        font-size: 13px;
        display: flex;
        align-items: center;
    }

    .card-link i {
        font-size: 11px;
        margin-left: 5px;
    }

    .location-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 8px;
    }

    .location-icon {
        color: #666;
        margin-right: 8px;
        min-width: 14px;
        margin-top: 3px;
    }

    .location-text {
        flex: 1;
        font-size: 12px;
        line-height: 1.4;
    }

    .location-distance {
        color: #666;
        font-size: 12px;
        text-align: right;
        white-space: nowrap;
        margin-left: 5px;
    }

    .amenity-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }

    .amenity-icon {
        color: #0064be;
        margin-right: 8px;
        min-width: 14px;
    }

    .amenity-text {
        font-size: 12px;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: repeat(2, 1fr);
        gap: 3px;
        height: 350px;
        overflow: hidden;
        margin-bottom: 12px;
    }

    .gallery-main {
        grid-column: span 2;
        grid-row: span 2;
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .gallery-item:hover img {
        transform: scale(1.05);
    }

    .view-all-photos {
        position: absolute;
        bottom: 12px;
        right: 12px;
        background: rgba(255, 255, 255, 0.9);
        color: #333;
        padding: 6px 10px;
        border-radius: 4px;
        font-size: 11px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .content-tabs {
        display: flex;
        background-color: white;
        border-bottom: 2px solid #e0e0e0;
        overflow-x: auto;
        white-space: nowrap;
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .tab-item {
        padding: 10px 20px;
        color: #666;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        border-bottom: 3px solid transparent;
    }

    .tab-item.active {
        color: #0064be;
        border-bottom-color: #0064be;
    }

    .room-header {
        margin-bottom: 15px;
    }

    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .room-item {
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        margin-bottom: 10px;
        overflow: hidden;
    }

    .room-item-header {
        background-color: #f5f5f5;
        padding: 8px 10px;
        font-weight: 600;
        font-size: 14px;
        color: #333;
        border-bottom: 1px solid #e0e0e0;
    }

    .room-item-content {
        padding: 10px;
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
    }

    .room-image {
        width: 50%;
        overflow: hidden;
        border-radius: 4px;
        margin-right: 10px;
    }

    .room-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 4px;
    }

    .room-details {
        flex: 1;
        min-width: 200px;
        padding-right: 10px;
    }

    .room-description {
        font-size: 12px;
        color: #333;
        margin-bottom: 8px;
        line-height: 1.4;
        max-height: 40px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .room-features {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .room-feature {
        display: flex;
        align-items: center;
        font-size: 12px;
        color: #666;
    }

    .room-feature i {
        color: #0064be;
        margin-right: 4px;
        font-size: 12px;
    }

    .room-pricing {
        width: 160px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .room-pricing .price-label {
        font-size: 11px;
        color: #666;
        margin-bottom: 2px;
    }

    .room-pricing .price-value {
        font-size: 16px;
        font-weight: 700;
        color: #ff5e1f;
        margin-bottom: 0;
    }

    .room-pricing .price-unit {
        font-size: 11px;
        color: #666;
        margin-bottom: 8px;
    }

    .room-pricing .book-button {
        padding: 6px 12px;
        font-size: 12px;
    }

    /* CSS for discount badge and original price */
    .discount-badge {
        color: red;
        padding: 2px 6px;
        border-radius: 3px;
        font-size: 11px;
        display: inline-block;
        margin-bottom: 4px;
        font-weight: 600;
    }

    .price-original {
        text-decoration: line-through;
        font-size: 12px;
        color: #999;
        margin-bottom: 2px;
    }

    /* CSS for amenities selection */
    .amenities-selection {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 6px;
    }

    .amenity-checkbox {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        color: #333;
    }

    .amenity-checkbox input {
        width: auto;
    }

    @media (max-width: 992px) {
        .info-cards {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .header-container {
            flex-direction: column;
        }

        .pricing-container {
            text-align: left;
            margin-top: 8px;
        }

        .book-button {
            margin-top: 8px;
            width: 100%;
        }

        .info-cards {
            grid-template-columns: 1fr;
        }

        .room-item-content {
            flex-direction: column;
        }

        .room-image {
            width: 100%;
            height: 150px;
            margin-right: 0;
            margin-bottom: 10px;
        }

        .room-details {
            width: 100%;
            padding-right: 0;
            margin-bottom: 10px;
        }

        .room-pricing {
            width: 100%;
        }

        .room-pricing .book-button {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
@if(isset($homestay))
<div class="container">
    <div class="content-tabs">
        <div class="tab-item active">Tổng quan</div>
        <div class="tab-item">Phòng</div>
        <div class="tab-item">Vị trí</div>
        <div class="tab-item">Tiện ích</div>
        <div class="tab-item">Chính sách</div>
        <div class="tab-item">Đánh giá</div>
    </div>

    <div class="breadcrumb">
        <a href="{{ '/' }}">Khách sạn</a>
        <span>/</span>
        <a href="#">Việt Nam (17.236 Nhà nghỉ Homestay)</a>
        <span>/</span>
        <a href="#">Hà Nội (2.911 Nhà nghỉ Homestay)</a>
        <span>/</span>
        <a href="#">Quận Đống Đa (136 Nhà nghỉ Homestay)</a>
        <span>/</span>
        <a href="#">Cát Linh (19 Nhà nghỉ Homestay)</a>
        <span>/</span>
        <span>{{ $homestay['name'] }}</span>
        <a href="#" style="margin-left: auto; display: flex; align-items: center;">Xem cơ sở lưu trú khác tại Quận Đống Đa</a>
    </div>

    <div class="gallery-grid">
        <div class="gallery-item gallery-main">
            <img src="{{ file_url($homestay['image']) }}" alt="{{ $homestay['name'] }}">
        </div>
        <?php
        $gallery_images = [];
        if (isset($rooms) && is_array($rooms) && count($rooms) > 0) {
            foreach ($rooms as $room) {
                if (!empty($room['image1'])) $gallery_images[] = ['src' => file_url($room['image1']), 'alt' => $room['name']];
                if (!empty($room['image2'])) $gallery_images[] = ['src' => file_url($room['image2']), 'alt' => $room['name']];
                if (!empty($room['image3'])) $gallery_images[] = ['src' => file_url($room['image3']), 'alt' => $room['name']];
                if (!empty($room['image4'])) $gallery_images[] = ['src' => file_url($room['image4']), 'alt' => $room['name']];
            }
        }
        if (count($gallery_images) < 4) {
            for ($i = count($gallery_images); $i < 4; $i++) {
                $gallery_images[] = ['src' => file_url($homestay['image']), 'alt' => $homestay['name']];
            }
        }
        for ($i = 0; $i < min(4, count($gallery_images)); $i++) {
            if ($i < 3) {
                echo '<div class="gallery-item"><img src="' . $gallery_images[$i]['src'] . '" alt="' . $gallery_images[$i]['alt'] . '"></div>';
            } else {
                echo '<div class="gallery-item"><img src="' . $gallery_images[$i]['src'] . '" alt="' . $gallery_images[$i]['alt'] . '"><div class="view-all-photos"><i class="far fa-images"></i> Xem tất cả hình ảnh</div></div>';
            }
        }
        ?>
    </div>

    <div class="main-grid">
        <div class="content-main">
            <div class="header-container panel-section">
                <div class="homestay-info">
                    <h1 class="homestay-title">{{ $homestay['name'] }}</h1>
                    <div class="homestay-type-rating">
                        <span class="homestay-type">Nhà Nghỉ Homestay</span>
                        <span class="star-rating">
                            @php
                            $rating = floatval($homestay['rating']);
                            $full_stars = floor($rating);
                            $half_star = ($rating - $full_stars) >= 0.5 ? 1 : 0;
                            $empty_stars = 5 - $full_stars - $half_star;
                            @endphp
                            @for ($i = 0; $i < $full_stars; $i++)
                                <i class="fas fa-star"></i>
                                @endfor
                                @if ($half_star)
                                <i class="fas fa-star-half-alt"></i>
                                @endif
                                @for ($i = 0; $i < $empty_stars; $i++)
                                    <i class="far fa-star"></i>
                                    @endfor
                        </span>
                    </div>
                </div>
                <div class="price-value">{{ number_format($homestay['price'] ?? 450000, 0, ',', '.') }} VND</div>
            </div>

            <div class="urgency-alert">
                <div class="clock-icon">
                    <i class="far fa-clock"></i>
                </div>
                <div class="urgency-message">
                    Dừng khoảng chừng là 2 giây! Chỉ còn <span class="urgency-highlight">1 phòng</span> có giá thấp nhất này!
                </div>
            </div>

            <div class="info-cards">
                <div class="info-card">
                    <div class="rating-display">
                        <i class="fas fa-dove" style="color: #0064be; font-size: 22px; margin-right: 10px;"></i>
                        <span class="rating-value">{{ number_format($homestay['rating'], 1) }}</span>
                        <span class="rating-scale">/5</span>
                    </div>
                    <div class="rating-label">
                        @php
                        $rating = floatval($homestay['rating']);
                        if ($rating >= 4.5) {
                        echo 'Xuất sắc';
                        } elseif ($rating >= 4.0) {
                        echo 'Rất tốt';
                        } elseif ($rating >= 3.5) {
                        echo 'Tốt';
                        } elseif ($rating >= 3.0) {
                        echo 'Khá';
                        } else {
                        echo 'Trung bình';
                        }
                        @endphp
                    </div>
                    <a href="#" class="review-link">{{ $homestay['review_count'] ?? 0 }} đánh giá <i class="fas fa-chevron-right"></i></a>
                    <div class="review-heading">Khách nói gì về kỳ nghỉ của họ</div>
                    <div class="tag-container">
                        <div class="tag">Khoảng Cách Đến Trung Tâm (11)</div>
                        <div class="tag">Nhân Viên Thân Thiện (10)</div>
                    </div>
                    <div class="tag-container">
                        <div class="tag">Khu Vực Xung Quanh (9)</div>
                        <div class="tag">Wifi (8)</div>
                    </div>
                    @if(isset($ratings) && count($ratings) > 0)
                    <div class="review-divider"></div>
                    <div class="reviewer-name">{{ $ratings[0]['full_name'] }}</div>
                    <div class="review-score">{{ number_format($ratings[0]['score'], 1) }} / 5</div>
                    <div class="review-text">{{ $ratings[0]['content'] ?? 'Không có nội dung đánh giá.' }}</div>
                    @else
                    <div class="review-divider"></div>
                    <div class="review-text">Chưa có đánh giá nào cho homestay này.</div>
                    @endif
                </div>
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-title">Trong khu vực</div>
                        <a href="#" class="card-link">Xem bản đồ <i class="fas fa-chevron-right"></i></a>
                    </div>
                    <div class="location-item">
                        <i class="fas fa-map-marker-alt location-icon"></i>
                        <div class="location-text">No. 29 Hang Chao Alley, Cát Linh, Quận Đống Đa, Hà Nội, Việt Nam, 115500</div>
                    </div>
                    <div class="location-item">
                        <i class="fas fa-bus location-icon"></i>
                        <div class="location-text">Xung quanh trung tâm giải trí</div>
                    </div>
                    <div class="location-item">
                        <i class="fas fa-train location-icon"></i>
                        <div class="location-text">Phố Đường Tàu Hà Nội</div>
                        <div class="location-distance">1.07 km</div>
                    </div>
                    <div class="location-item">
                        <i class="fas fa-landmark location-icon"></i>
                        <div class="location-text">Nhà thờ Lớn Hà Nội</div>
                        <div class="location-distance">1.57 km</div>
                    </div>
                    <div class="location-item">
                        <i class="fas fa-water location-icon"></i>
                        <div class="location-text">Hồ Hoàn Kiếm</div>
                        <div class="location-distance">1.91 km</div>
                    </div>
                </div>
                <div class="info-card">
                    <div class="card-header">
                        <div class="card-title">Tiện ích chính</div>
                        <a href="#" class="card-link">Xem thêm <i class="fas fa-chevron-right"></i></a>
                    </div>
                    @if(isset($amenities) && count($amenities) > 0)
                    @foreach($amenities as $amenity)
                    <div class="amenity-item">
                        <i class="{{ $amenity['icon'] ?? 'fas fa-check' }} amenity-icon"></i>
                        <div class="amenity-text">{{ $amenity['name'] }}</div>
                    </div>
                    @endforeach
                    @else
                    <div class="amenity-item">
                        <div class="amenity-text">Không có thông tin tiện ích</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Trong phần đánh giá (sau đoạn hiển thị các đánh giá hiện có) -->
            @if(isset($ratings) && count($ratings) > 0)
            <div class="review-divider"></div>
            <div class="reviewer-name">{{ $ratings[0]['full_name'] }}</div>
            <div class="review-score">{{ number_format($ratings[0]['score'], 1) }} / 5</div>
            <div class="review-text">{{ $ratings[0]['content'] ?? 'Không có nội dung đánh giá.' }}</div>
            @else
            <div class="review-divider"></div>
            <div class="review-text">Chưa có đánh giá nào cho homestay này.</div>
            @endif

            <!-- Thêm form đánh giá -->
            @if($canRate && !$existingRating)
            <div class="review-form" style="margin-top: 20px;">
                <h3 class="review-heading">Để lại đánh giá của bạn</h3>
                @if(isset($error))
                <div style="color: red; margin-bottom: 10px;">{{ $error }}</div>
                @endif
                <form method="POST" action="">
                    <div class="form-group">
                        <label class="form-label">Điểm số (0-5)</label>
                        <input type="number" class="form-input" name="score" min="0" max="5" step="0.1" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nội dung đánh giá</label>
                        <textarea class="form-input" name="content" rows="3" placeholder="Chia sẻ trải nghiệm của bạn..." required></textarea>
                    </div>
                    <button type="submit" name="submit_rating" class="book-button">Gửi đánh giá</button>
                </form>
            </div>
            @elseif($existingRating)
            <div class="review-text" style="margin-top: 10px; color: #666;">
                Bạn đã đánh giá homestay này: {{ number_format($existingRating['score'], 1) }} / 5 - {{ $existingRating['content'] }}
            </div>
            @else
            <div class="review-text" style="margin-top: 10px; color: #666;">
                Bạn cần đặt phòng và được xác nhận để có thể đánh giá homestay này.
            </div>
            @endif
            <div class="panel-section">
                <div class="room-header">
                    <h2 class="section-title">Những phòng còn trống tại {{ $homestay['name'] }}</h2>
                </div>

                @if(isset($rooms) && count($rooms) > 0)
                @foreach($rooms as $room)
                <div class="room-item">
                    <div class="room-item-header">
                        {{ $room['name'] }}
                    </div>
                    <div class="room-item-content">
                        <div class="room-image">
                            <img src="{{ !empty($room['image1']) ? file_url($room['image1']) : file_url($homestay['image']) }}" alt="{{ $room['name'] }}">
                        </div>
                        <div class="room-details">
                            <div class="room-description">{{ $room['description'] ?? 'Phòng tiện nghi với đầy đủ tiện ích hiện đại.' }}</div>
                            <div class="room-features">
                                <div class="room-feature">
                                    <i class="fas fa-user-friends"></i>
                                    <span>{{ $room['capacity'] ?? 3 }} khách</span>
                                </div>
                            </div>
                        </div>
                        <div class="room-pricing">
                            <form action="/booking/{{ $homestay['id'] }}" method="GET" class="booking-form">
                                <input type="hidden" name="room_id" value="{{ $room['id'] }}">
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Ngày nhận phòng</label>
                                        <input type="date" class="form-input" name="check_in" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Ngày trả phòng</label>
                                        <input type="date" class="form-input" name="check_out" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Số lượng khách</label>
                                        <input type="number" class="form-input" name="guests" min="1" max="{{ $room['capacity'] ?? 1 }}" value="1" required>
                                    </div>
                                    @if(isset($amenities) && count($amenities) > 0)
                                    <div class="form-group">
                                        <label class="form-label">Tiện ích</label>
                                        <div class="amenities-selection">
                                            @foreach($amenities as $amenity)
                                            <div class="amenity-checkbox">
                                                <input type="checkbox" name="amenities[]" value="{{ $amenity['name'] }}" checked>
                                                <span>{{ $amenity['name'] }}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <div class="price-label">Giá mỗi đêm từ</div>
                                        @if(isset($room['discount']) && $room['discount'] > 0)
                                        <div class="price-original">{{ number_format($room['price'], 0, ',', '.') }} VND</div>
                                        <div class="price-value">{{ number_format($room['price'] * (1 - $room['discount']/100), 0, ',', '.') }} VND</div>
                                        <div class="discount-badge">Giảm {{ $room['discount'] }}%</div>
                                        @else
                                        <div class="price-value">{{ number_format($room['price'] ?? 450000, 0, ',', '.') }} VND</div>
                                        @endif
                                        <div class="price-unit">/ đêm</div>
                                        <button type="submit" class="book-button">Chọn phòng</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div style="padding: 15px 0; text-align: center; color: #666;">
                    <p>Không tìm thấy phòng trống cho homestay này.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@else
<div class="container" style="padding: 50px 0; text-align: center;">
    <div class="panel-section">
        <h2 style="margin-bottom: 15px; color: #333;">Không tìm thấy thông tin homestay</h2>
        <p style="color: #666; margin-bottom: 20px;">Homestay này không tồn tại hoặc đã bị xóa</p>
        <a href="{{ '/' }}" style="display: inline-block; background: #0770cd; color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; font-weight: 600;">Quay lại trang chủ</a>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabItems = document.querySelectorAll('.tab-item');
        tabItems.forEach(tab => {
            tab.addEventListener('click', () => {
                tabItems.forEach(item => item.classList.remove('active'));
                tab.classList.add('active');
            });
        });

        const viewAllPhotosBtn = document.querySelector('.view-all-photos');
        if (viewAllPhotosBtn) {
            viewAllPhotosBtn.addEventListener('click', function() {
                alert('Chức năng xem tất cả hình ảnh sẽ được phát triển sau');
            });
        }
    });
</script>
@endsection