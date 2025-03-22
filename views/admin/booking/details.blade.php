@extends('admin.layout')
@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f8f8;
        }

        .hotel-container {
            margin-left: 500px;
            max-width: 800px;
            margin-top: 100px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* Tiêu đề */
        .hotel-name {
            color: #333;
            font-size: 24px;
            margin-bottom: 5px;
        }

        /* Thông tin Booking */
        .booking-details {
            margin-top: 15px;
            padding: 15px;
            background: #f1f1f1;
            border-radius: 10px;
        }

        .booking-details p {
            margin: 5px 0;
            font-size: 16px;
        }

        .booking-details strong {
            color: #007bff;
        }

        /* Đánh giá & Nhận xét */
        .hotel-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 15px;
            padding: 10px;
            background: #f1f1f1;
            border-radius: 10px;
        }

        .rating {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .score {
            background: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 18px;
        }

        .review p {
            font-style: italic;
            margin: 0;
        }

        .review span {
            font-size: 12px;
            color: #777;
        }
    </style>

    <div class="hotel-container">
        <h1 class="hotel-name">Booking ID: {{$booking['id']}}</h1>
        <!-- Thông tin chi tiết -->
        <div class="booking-details">
            @foreach($user as $users)
                @if($booking['user_id'] == $users['id'])
                    <p><strong>Khách hàng:</strong> {{$users['full_name']}}</p>
                @endif
            @endforeach
                @foreach($room as $rooms)
                    @if($booking['room_id'] == $rooms['id'])
                        <p><strong>Phòng:</strong> {{$rooms['name']}}</p>
                    @endif
                @endforeach
                <p><strong>Giá:</strong> {{ number_format($booking['total_price'], 0, ',', '.') }} VNĐ</p>
                    <p><strong>Ngày đặt:</strong> {{date('d/m/Y H:i:s', strtotime($booking['created_at']))}}</p>
            <p><strong>Trạng thái:</strong> {{$booking['status']}}</p>
        </div>
        <a href="/admin/bookings/">Back</a>
@endsection
