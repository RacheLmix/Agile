@extends('admin.layout')
@section('content')
    <style>
        /* CSS cho container chính */
        .hotel-container {
            margin: 50px 0;
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

        /* CSS cho trạng thái status */
        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        .status-pending {
            background-color: #fff8e6; /* Vàng nhạt */
            color: #e6a700; /* Vàng đậm */
        }

        .status-confirmed {
            background-color: #e6f7ee; /* Xanh nhạt */
            color: #00b74a; /* Xanh lá */
        }

        .status-cancelled {
            background-color: #feeaec; /* Hồng nhạt */
            color: #f44336; /* Đỏ */
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
        <h1 class="hotel-name">Booking ID: {{ $booking['id'] }}</h1>
        <!-- Thông tin chi tiết -->
        <div class="booking-details">
            @foreach($user as $users)
                @if($booking['user_id'] == $users['id'])
                    <p><strong>Khách hàng:</strong> {{ $users['full_name'] }}</p>
                @endif
            @endforeach
            @foreach($room as $rooms)
                @if($booking['room_id'] == $rooms['id'])
                    <p><strong>Phòng:</strong> {{ $rooms['name'] }}</p>
                @endif
            @endforeach
            <p><strong>Giá:</strong> {{ number_format($booking['total_price'], 0, ',', '.') }} VNĐ</p>
            <p><strong>Ngày đặt:</strong> {{ date('d/m/Y H:i:s', strtotime($booking['created_at'])) }}</p>
            <p><strong>Trạng thái:</strong> 
                <span class="status status-{{ strtolower($booking['status']) }}">
                    {{ $booking['status'] == 'pending' ? 'Đang chờ' : 
                       ($booking['status'] == 'confirmed' ? 'Đã xác nhận' : 'Đã hủy') }}
                </span>
            </p>
            <a href="/admin/bookings/" class="btn btn-primary">Quay lại</a>
        </div>
    </div>
@endsection