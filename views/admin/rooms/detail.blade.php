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
    </style>

    <div class="hotel-container">
        @foreach($homestays as $homestay)
            @if($rooms['homestay_id'] == $homestay['id'])
                <h1 class="hotel-name">Homestay: {{ $homestay['name'] }}</h1>
            @endif
        @endforeach
        <h1 class="hotel-name">Room ID: {{ $rooms['id'] }}</h1>

        <div class="booking-details">
            <p><strong>Mô tả:</strong> {{ $rooms['description'] }}</p>
            <p><strong>Số lượng:</strong> {{ $rooms['quantity'] }}</p>
            <p><strong>Dung tích:</strong> {{ $rooms['capacity'] }}</p>
            <p><strong>Giá:</strong> {{ number_format($rooms['price'], 0, ',', '.') }} VNĐ</p>
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
