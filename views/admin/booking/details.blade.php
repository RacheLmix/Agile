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
        
        .status-completed {
            background-color: #e3f2fd; /* Xanh dương nhạt */
            color: #1976d2; /* Xanh dương */
        }
        
        /* CSS cho tiện ích */
        .amenities-section {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
        
        .amenities-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        
        .amenity-item {
            background-color: #f8f9fa;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            color: #495057;
            display: flex;
            align-items: center;
        }
        
        .amenity-item i {
            margin-right: 5px;
            color: #0064be;
        }
        
        /* CSS cho thông tin homestay */
        .homestay-info {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
        
        .booking-summary {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        
        .booking-summary h3 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #333;
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
                    <p><strong>Email:</strong> {{ $users['email'] }}</p>
                    @if(isset($users['phone']))
                    <p><strong>Số điện thoại:</strong> {{ $users['phone'] }}</p>
                    @endif
                @endif
            @endforeach
            
            @php
                $roomName = '';
                $homestayName = '';
                foreach($room as $rooms) {
                    if($booking['room_id'] == $rooms['id']) {
                        $roomName = $rooms['name'];
                        break;
                    }
                }
            @endphp
            
            <p><strong>Phòng:</strong> {{ $roomName }}</p>
            
            @if($homestayDetails)
            <p><strong>Homestay:</strong> {{ $homestayDetails['name'] }}</p>
            <p><strong>Địa chỉ:</strong> {{ $homestayDetails['address'] }}, {{ $homestayDetails['location'] }}</p>
            @endif
            
            <p><strong>Check-in:</strong> {{ date('d/m/Y', strtotime($booking['check_in'])) }}</p>
            <p><strong>Check-out:</strong> {{ date('d/m/Y', strtotime($booking['check_out'])) }}</p>
            <p><strong>Thời gian lưu trú:</strong> {{ $duration }} đêm</p>
            <p><strong>Giá:</strong> {{ number_format($booking['total_price'], 0, ',', '.') }} VNĐ</p>
            <p><strong>Ngày đặt:</strong> {{ date('d/m/Y H:i:s', strtotime($booking['created_at'])) }}</p>
            <p><strong>Trạng thái:</strong> 
                <span class="status status-{{ strtolower($booking['status']) }}">
                    @if($booking['status'] == 'pending')
                        Đang chờ
                    @elseif($booking['status'] == 'confirmed')
                        Đã xác nhận
                    @elseif($booking['status'] == 'cancelled')
                        Đã hủy
                    @elseif($booking['status'] == 'completed')
                        Hoàn thành
                    @else
                        {{ $booking['status'] }}
                    @endif
                </span>
            </p>
            
            @if($homestayDetails && count($amenities) > 0)
            <div class="amenities-section">
                <h3>Tiện ích Homestay</h3>
                <div class="amenities-list">
                    @foreach($amenities as $amenity)
                    <div class="amenity-item">
                        @if($amenity['icon'])
                        <i class="{{ $amenity['icon'] }}"></i>
                        @else
                        <i class="fas fa-check"></i>
                        @endif
                        {{ $amenity['name'] }}
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            
            <div class="booking-summary">
                <h3>Tóm tắt đặt phòng</h3>
                <p><strong>Ngày đặt:</strong> {{ date('d/m/Y H:i:s', strtotime($booking['created_at'])) }}</p>
                <p><strong>Phương thức thanh toán:</strong> {{ $booking['payment_method'] ?? 'Thanh toán tại chỗ' }}</p>
                @if(isset($booking['notes']) && !empty($booking['notes']))
                <p><strong>Ghi chú:</strong> {{ $booking['notes'] }}</p>
                @endif
            </div>
            
            <div style="margin-top: 20px;">
                <a href="/admin/bookings/" class="btn btn-primary">Quay lại</a>
                <a href="/admin/bookings/edit/{{ $booking['id'] }}" class="btn btn-primary" style="margin-left: 10px;">Cập nhật trạng thái</a>
            </div>
        </div>
    </div>
@endsection