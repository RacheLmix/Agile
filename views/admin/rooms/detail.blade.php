@extends('admin.layout')
@section('content')
    <style>
        /* CSS cho container chính */
        .hotel-container {
            width: calc(100% - 50px);
            margin: 70px auto 30px 280px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.08);
            transition: margin-left 0.3s, width 0.3s;
        }

        /* Tiêu đề */
        .hotel-name {
            color: #333;
            font-size: 20px;
            margin: 0 0 20px 0;
            font-weight: 600;
        }

        /* Thông tin chi tiết */
        .booking-details {
            margin-top: 15px;
        }

        .booking-details p {
            margin: 10px 0;
            font-size: 14px;
            color: #495057;
        }

        .booking-details strong {
            color: #0064be; /* Đồng bộ với btn-primary */
            font-weight: 600;
        }

        /* Kiểu cho ảnh */
        .booking-details img {
            width: 100px;
            border-radius: 4px;
            margin-left: 10px;
            vertical-align: middle;
        }

        /* Nút Back */
        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            border: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #0064be;
            color: white;
        }

        /* CSS cho trạng thái status (nếu cần) */
        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .status-available {
            background-color: #e6f7ee; /* Xanh nhạt */
            color: #00b74a; /* Xanh lá */
        }

        .status-unavailable {
            background-color: #feeaec; /* Hồng nhạt */
            color: #f44336; /* Đỏ */
        }

        .status-maintenance {
            background-color: #fff8e6; /* Vàng nhạt */
            color: #e6a700; /* Vàng đậm */
        }

        /* Responsive cho màn hình nhỏ */
        @media (max-width: 992px) {
            .hotel-container {
                width: calc(100% - 40px);
                margin: 70px 20px 30px 20px;
            }
        }
    </style>

    <div class="hotel-container">
        @foreach($homestays as $homestay)
            @if($rooms['homestay_id'] == $homestay['id'])
                <h1 class="hotel-name">HomeStay: {{ $homestay['name'] }}</h1>
            @endif
        @endforeach
        <h1 class="hotel-name">Room ID: {{ $rooms['id'] }}</h1>
        <div class="booking-details">
            <p><strong>Mô tả:</strong> {{ $rooms['description'] }}</p>
            <p><strong>Số lượng:</strong> {{ $rooms['quantity'] }}</p>
            <p><strong>Dung tích:</strong> {{ $rooms['capacity'] }}</p>
            <p><strong>Ảnh:</strong> 
                @if($rooms['image1'])
                    <img src="{{ file_url($rooms['image1']) }}" alt="{{ $rooms['name'] }}">
                @endif
            </p>
            <p><strong>Giá:</strong> {{ number_format($rooms['price'], 0, ',', '.') }} VNĐ</p>
            <p><strong>Trạng thái:</strong> 
                <span class="status status-{{ strtolower($rooms['status']) }}">
                    {{ $rooms['status'] == 'available' ? 'Còn trống' : 
                       ($rooms['status'] == 'unavailable' ? 'Đã thuê' : 'Đang bảo trì') }}
                </span>
            </p>
            <a href="/admin/rooms/" class="btn btn-primary">Quay lại</a>
        </div>
    </div>
@endsection