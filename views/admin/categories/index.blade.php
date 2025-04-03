@extends('admin.layout')

@section('title', 'Quản lý Danh Mục')

@section('content')
    <style>
        .table-container {
            margin: 50px 0;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.08);
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

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .category-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .category-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        .category-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 12px;
        }

        .card-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .btn-sm {
            padding: 6px 10px;
            font-size: 12px;
            border-radius: 4px;
            text-align: center;
            flex: 1;
            text-decoration: none;
        }

        .btn-edit {
            background-color: #ff9800;
            color: white;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
        }

        .btn-detail {
            background-color: #28a745; /* Màu xanh lá cho nút xem chi tiết */
            color: white;
        }

        .empty-message {
            text-align: center;
            padding: 30px;
            color: #666;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
    </style>
    <div class="table-container">
        <div class="table-header">
            <h2>Quản lý Danh Mục</h2>
            <div class="action-buttons">
                <a href="/admin/categories/create" class="btn btn-primary">Thêm mới Danh Mục</a>
            </div>
        </div>
        @if(!empty($category) && is_array($category))
            <div class="category-grid">
                @foreach($category as $categories)
                    <div class="category-card">
                        <h3 class="category-title">{{ $categories['name'] }}</h3>
                        <p class="category-description">{{ $categories['description'] }}</p>
                        <div class="card-actions">
                            <a href="/admin/categories/detail/{{ $categories['id'] }}" class="btn-sm btn-detail">Xem chi tiết</a>
                            <a href="/admin/categories/edit/{{ $categories['id'] }}" class="btn-sm btn-edit">Sửa</a>
                            <a onclick="return confirm('Bạn có chắc muốn xóa danh mục {{ $categories['name'] }} không?')"
                               href="/admin/categories/delete/{{ $categories['id'] }}" class="btn-sm btn-delete">Xóa</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-message">
                <p>Không có danh mục nào. Hãy thêm danh mục mới!</p>
            </div>
        @endif
    </div>
@endsection