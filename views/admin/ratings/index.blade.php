@extends('admin.layout')

@section('title', 'Danh sách đánh giá')

@section('content')
    <style>
        /* CSS cho table-container và bảng */
        .table-container {
            margin: 50px 0;
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
            text-decoration: none;
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

        /* Responsive cho màn hình nhỏ */
        @media (max-width: 992px) {
            .table-container {
                width: calc(100% - 40px);
                margin: 70px 20px 30px 20px;
            }
        }
    </style>

    <div class="table-container">
        <div class="table-header">
            <h2>Danh sách đánh giá</h2>
            <div class="action-buttons">
                <!-- Có thể thêm nút nếu cần, ví dụ: Thêm đánh giá -->
            </div>
        </div>
        
        @if(empty($ratings))
        <div class="empty-message">
            <p>Chưa có đánh giá nào.</p>
        </div>
        @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên người dùng</th>
                    <th>Tên Homestay</th>
                    <th>Điểm</th>
                    <th>Nội dung</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ratings as $rating)
                    <tr>
                        <td>{{ $rating['id'] }}</td>
                        <td>{{ $rating['user_name'] ?? 'N/A' }}</td>
                        <td>{{ $rating['homestay_name'] ?? 'N/A' }}</td>
                        <td>{{ $rating['score'] ?? 'Chưa đánh giá' }}</td>
                        <td>{{ $rating['content'] ?? 'Không có nội dung' }}</td>
                        <td>{{ date('d/m/Y H:i', strtotime($rating['created_at'])) }}</td>
                        <td class="action-cell">
                            <a href="/admin/ratings/detail/{{ $rating['id'] }}" class="btn btn-sm btn-info">Chi tiết</a>
                            <a href="/admin/ratings/edit/{{ $rating['id'] }}" class="btn btn-sm btn-warning">Sửa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
@endsection