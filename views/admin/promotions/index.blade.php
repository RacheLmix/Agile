@extends('admin.layout')

@section('title', 'Quản lý Khuyến mãi')

@section('content')
<style>
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
    
    .status {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .status-active {
        background-color: #e6f7ee;
        color: #00b74a;
    }
    
    .status-inactive {
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
    
    .btn-danger {
        background-color: #f44336;
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
</style>

<div class="table-container">
    <div class="table-header">
        <h2>Quản lý Khuyến mãi</h2>
        <div class="action-buttons">
            <a href="/admin/promotions/create" class="btn btn-primary">Thêm khuyến mãi mới</a>
        </div>
    </div>
    
    @if(count($promotions) > 0)
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Tên Phòng</th>
                <th>Giảm giá (%)</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($promotions as $promotion)
                <tr>
                    <td>{{ $promotion['id'] }}</td>
                    <td>{{ $promotion['title'] }}</td>
                    <td>{{ $promotion['room_name'] }}</td>
                    <td>{{ number_format($promotion['discount_percent'], 2, '.', '') }}%</td>
                    <td>{{ $promotion['start_date'] }}</td>
                    <td>{{ $promotion['end_date'] }}</td>
                    <td>
                        <span class="status status-{{ strtolower($promotion['status']) }}">
                            {{ $promotion['status'] == 'active' ? 'Hoạt động' : 'Không hoạt động' }}
                        </span>
                    </td>
                    <td class="action-cell">
                        <a href="/admin/promotions/edit/{{ $promotion['id'] }}" class="btn btn-sm btn-warning">Sửa</a>
                        <a href="/admin/promotions/delete/{{ $promotion['id'] }}" class="btn btn-sm btn-danger"
                           onclick="return confirm('Bạn có chắc muốn xóa khuyến mãi {{ $promotion['title'] }} không?')">
                            Xóa
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="empty-message">
        <p>Không có khuyến mãi nào. Hãy thêm khuyến mãi mới!</p>
    </div>
    @endif
</div>
@endsection