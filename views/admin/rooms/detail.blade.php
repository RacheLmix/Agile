@extends('admin.layout')
@section('content')
    <style>
        .hotel-container {
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.08);
            max-width: 800px;
        }

        .hotel-name {
            color: #333;
            font-size: 20px;
            font-weight: 600;
        }

        .booking-details p {
            margin: 10px 0;
            font-size: 14px;
            color: #495057;
        }

        .booking-details strong {
            color: #0064be;
            font-weight: 600;
        }

        /* Kiểu ảnh */
        .room-images {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .room-images img {
            width: 120px;
            height: 90px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        /* Trạng thái */
        .status {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }

        .status-available {
            background-color: #e6f7ee;
            color: #00b74a;
        }

        .status-unavailable {
            background-color: #feeaec;
            color: #f44336;
        }

        .status-maintenance {
            background-color: #fff8e6;
            color: #e6a700;
        }

        /* Nút */
        .btn {
            padding: 10px 16px;
            border-radius: 4px;
            font-size: 14px;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
            display: inline-block;
            border: none;
            margin-top: 10px;
        }

        .btn-primary {
            background-color: #0064be;
            color: white;
        }

        /* Thêm CSS cho phần khuyến mãi */
        .promotion-section {
            margin: 20px 0;
            padding: 15px;
            border-radius: 8px;
            background-color: #fff8f8;
            border: 1px dashed #ff4444;
        }

        .promotion-title {
            color: #ff4444;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .promotion-details {
            font-size: 14px;
            color: #666;
        }

        .price-section {
            margin: 15px 0;
        }

        .original-price {
            text-decoration: line-through;
            color: #999;
            font-size: 14px;
        }

        .discounted-price {
            color: #ff4444;
            font-size: 18px;
            font-weight: bold;
            margin-top: 5px;
        }

        .no-promotion {
            color: #666;
            font-style: italic;
            padding: 10px 0;
        }

        .promotion-period {
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px solid #ffcdd2;
            color: #666;
            font-size: 13px;
        }

        /* Thêm style cho khuyến mãi hết hạn */
        .expired-promotion {
            margin: 15px 0;
            padding: 15px;
            background-color: #f5f5f5;
            border: 1px dashed #999;
            border-radius: 8px;
        }

        .expired-tag {
            display: inline-block;
            padding: 4px 8px;
            background-color: #999;
            color: white;
            border-radius: 4px;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .promotion-info {
            color: #666;
            font-size: 14px;
        }

        .current-price {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-top: 10px;
        }
    </style>

    <div class="hotel-container">
        @foreach($homestays as $homestay)
            @if($rooms['homestay_id'] == $homestay['id'])
                <h1 class="hotel-name">Homestay: {{ $homestay['name'] }}</h1>
            @endif
        @endforeach
        <h1 class="hotel-name">Room ID: {{ $rooms['id'] }}</h1>

        <div class="booking-details">
            <p><strong>Tên phòng:</strong> {{ $rooms['name'] }}</p>
            <p><strong>Mô tả:</strong> {{ $rooms['description'] }}</p>
            <p><strong>Số lượng:</strong> {{ $rooms['quantity'] }}</p>
            <p><strong>Dung tích:</strong> {{ $rooms['capacity'] }}</p>

            <!-- Phần hiển thị giá và khuyến mãi -->
            <div class="price-section">
                <p><strong>Giá phòng:</strong></p>
                @if(!empty($promotions) && isset($promotions[0]) && $promotions[0]['status'] === 'active')
                    @php
                        $promotion = $promotions[0];
                        $discountedPrice = $rooms['price'] * (1 - $promotion['discount_percent'] / 100);
                    @endphp
                    <div class="promotion-section">
                        <div class="promotion-title">
                            🎉 Khuyến mãi đang áp dụng
                        </div>
                        <div class="promotion-details">
                            <p><strong>{{ $promotion['title'] }}</strong></p>
                            <p>{{ $promotion['description'] }}</p>
                            <div class="price-details">
                                <span class="original-price">
                                    Giá gốc: {{ number_format($rooms['price'], 0, ',', '.') }} VNĐ
                                </span>
                                <div class="discounted-price">
                                    Giá sau giảm: {{ number_format($discountedPrice, 0, ',', '.') }} VNĐ
                                    (Giảm {{ $promotion['discount_percent'] }}%)
                                </div>
                            </div>
                            <div class="promotion-period">
                                Thời gian áp dụng: {{ date('d/m/Y', strtotime($promotion['start_date'])) }} - 
                                {{ date('d/m/Y', strtotime($promotion['end_date'])) }}
                            </div>
                        </div>
                    </div>
                @elseif(!empty($promotions) && isset($promotions[0]) && $promotions[0]['status'] === 'expired')
                    <div class="price-section">
                        <div class="expired-promotion">
                            <div class="expired-tag">Khuyến mãi đã kết thúc</div>
                            <div class="promotion-info">
                                <p>{{ $promotions[0]['title'] }}</p>
                                <p>Đã hết hạn vào ngày: {{ date('d/m/Y', strtotime($promotions[0]['end_date'])) }}</p>
                            </div>
                        </div>
                        <div class="current-price">
                            Giá hiện tại: {{ number_format($rooms['price'], 0, ',', '.') }} VNĐ
                        </div>
                    </div>
                @else
                    <div class="price-section">
                        <div class="no-promotion">Không có khuyến mãi</div>
                        <div class="current-price">
                            {{ number_format($rooms['price'], 0, ',', '.') }} VNĐ
                        </div>
                    </div>
                @endif
            </div>

            <p><strong>Trạng thái:</strong>
                <span class="status status-{{ strtolower($rooms['status']) }}">
                    {{ $rooms['status'] == 'available' ? 'Còn trống' :
                       ($rooms['status'] == 'unavailable' ? 'Đã thuê' : 'Đang bảo trì') }}
                </span>
            </p>

            <p><strong>Ảnh phòng:</strong></p>
            <div class="room-images">
                @for ($i = 1; $i <= 4; $i++)
                    @if(!empty($rooms["image$i"]))
                        <img src="{{ file_url($rooms["image$i"]) }}" alt="Ảnh {{ $i }}">
                    @endif
                @endfor
            </div>

            <a href="/admin/rooms/" class="btn btn-primary">Quay lại</a>
        </div>
    </div>
@endsection
