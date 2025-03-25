@extends('admin.layout')
@section('content')
    <style>
        .table-container {
            width: calc(100% - 50px);
            margin: 70px 30px 30px 280px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.08);
            transition: margin-left 0.3s, width 0.3s;
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .table-header h2 {
            margin: 0;
            color: #333;
            font-size: 20px;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        
        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            border: none;
        }
        
        .btn-primary {
            background-color: #0064be;
            color: white;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f8f9fa;
        }
        
        .action-cell {
            display: flex;
            gap: 8px;
        }
        
        .btn-sm {
            padding: 4px 8px;
            font-size: 12px;
            border-radius: 4px;
        }
        
        .btn-info {
            background-color: #0064be;
            color: white;
        }
        
        .btn-warning {
            background-color: #ff9800;
            color: white;
        }
        
        .empty-message {
            text-align: center;
            padding: 30px;
            color: #666;
        }
        
        /* Kiểu cho màn hình nhỏ */
        @media (max-width: 992px) {
            .table-container {
                width: calc(100% - 40px);
                margin: 70px 20px 30px 20px;
            }
        }

        /* Thêm kiểu cho ảnh */
        td img {
            width: 100px;
            border-radius: 4px;
        }
    </style>

    <div class="table-container">
        <div class="table-header">
            <h2>Quản lý phòng</h2>
            <div class="action-buttons">
                <a href="/admin/rooms/create" class="btn btn-primary">Thêm phòng</a>
            </div>
        </div>
        
        @if(count($rooms) > 0)
        <table>
            <thead>
                <tr>
                    <th>Room ID</th>
                    <th>HomeStay Name</th>
                    <th>Room Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Capacity</th>
                    <th>Img</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                    <tr>
                        <td>{{ $room['id'] }}</td>
                        <td>{{ $room['name_homestay'] }}</td>
                        <td>{{ $room['name'] }}</td>
                        <td>{{ $room['description'] }}</td>
                        <td>{{ number_format($room['price'], 0, ',', '.') }} VND</td>
                        <td>{{ $room['quantity'] }}</td>
                        <td>{{ $room['capacity'] }}</td>
                        <td><img src="{{ file_url($room['image1']) }}" alt="{{ $room['name'] }}"></td>
                        <td>{{ $room['status'] }}</td>
                        <td class="action-cell">
                            <a href="/admin/rooms/detail/{{$room['id']}}" class="btn btn-sm btn-info">Chi tiết</a>
                            <a href="/admin/bookings/edit/{{$room['id']}}" class="btn btn-sm btn-warning">Sửa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-message">
            <p>Chưa có phòng nào.</p>
        </div>
        @endif
    </div>
@endsection