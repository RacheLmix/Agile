@extends('admin.layout')
@section('content')
    <style>
        .table-container {
            width: calc(100% - 50px);
            margin: 70px auto 30px 280px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.08);
            transition: margin-left 0.3s, width 0.3s;
        }
        
        /* Áp dụng margin khi sidebar mở */
        body.sidebar-open .table-container {
            margin-left: 280px;
            width: calc(100% - 330px);
        }
        
        /* Áp dụng margin khi sidebar đóng */
        body.sidebar-closed .table-container {
            margin-left: 80px;
            width: calc(100% - 130px);
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
        
        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-pending {
            background-color: #fff8e6;
            color: #e6a700;
        }
        
        .status-confirmed {
            background-color: #e6f7ee;
            color: #00b74a;
        }
        
        .status-cancelled {
            background-color: #feeaec;
            color: #f44336;
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
            
            body.sidebar-open .table-container,
            body.sidebar-closed .table-container {
                margin-left: 20px;
                width: calc(100% - 40px);
            }
        }
    </style>

    <div class="table-container">
        <div class="table-header">
            <h2>Quản lý đặt phòng</h2>
            <div class="action-buttons">
                <a href="/admin/bookings/export" class="btn btn-primary">Xuất Excel</a>
            </div>
        </div>
        
        @if(count($booking) > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>Phòng</th>
                    <th>Check in</th>
                    <th>Check out</th>
                    <th>Số khách</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($booking as $book)
                    <tr>
                        <td>{{ $book['id'] }}</td>
                        <td>{{ $book['user_name'] }}</td>
                        <td>{{ $book['room_name'] }}</td>
                        <td>{{ date('d/m/Y', strtotime($book['check_in'])) }}</td>
                        <td>{{ date('d/m/Y', strtotime($book['check_out'])) }}</td>
                        <td>{{ $book['guests'] }}</td>
                        <td>{{ number_format($book['total_price'], 0, ',', '.') }} VND</td>
                        <td>
                            <span class="status status-{{ strtolower($book['status']) }}">
                                {{ $book['status'] == 'pending' ? 'Đang chờ' : 
                                   ($book['status'] == 'confirmed' ? 'Đã xác nhận' : 'Đã hủy') }}
                            </span>
                        </td>
                        <td class="action-cell">
                            <a href="/admin/bookings/details/{{$book['id']}}" class="btn btn-sm btn-info">Chi tiết</a>
                            <a href="/admin/bookings/edit/{{$book['id']}}" class="btn btn-sm btn-warning">Sửa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-message">
            <p>Chưa có đơn đặt phòng nào.</p>
        </div>
        @endif
    </div>
@endsection
