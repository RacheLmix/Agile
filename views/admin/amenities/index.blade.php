@extends('admin.layout')

@section('title', 'Quản lý Tiện ích')

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
    
    .amenity-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    .amenity-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .amenity-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .amenity-details {
        padding: 15px;
    }
    
    .amenity-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin: 0 0 10px 0;
    }
    
    .amenity-info {
        margin-bottom: 8px;
        font-size: 14px;
        color: #666;
    }
    
    .amenity-info strong {
        color: #333;
    }
    
    .truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .card-actions {
        display: flex;
        gap: 8px;
        margin-top: 12px;
        border-top: 1px solid #eee;
        padding-top: 12px;
    }
    
    .btn-sm {
        padding: 6px 10px;
        font-size: 12px;
        border-radius: 4px;
        text-align: center;
        flex: 1;
        text-decoration: none;
    }
    
    .btn-view {
        background-color: #0064be;
        color: white;
    }
    
    .btn-edit {
        background-color: #ff9800;
        color: white;
    }
    
    .btn-delete {
        background-color: #f44336;
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
        <h2>Quản lý Tiện ích</h2>
        <div class="action-buttons">
            <a href="/admin/amenities/create" class="btn btn-primary">Thêm mới Tiện ích</a>
        </div>
    </div>
    
    @if(count($amenities) > 0)
    <div class="amenity-grid">
        @foreach($amenities as $amenity)
        <div class="amenity-card">
            <div class="amenity-details">
                <h3 class="amenity-title">
                    <i class="{{ $amenity['icon'] }}"></i> {{ $amenity['name'] }}
                </h3>
                
                <p class="amenity-info truncate"><strong>Mô tả:</strong> {{ $amenity['description'] ?? 'Không có mô tả' }}</p>
                <p class="amenity-info"><strong>Ngày tạo:</strong> {{ date('d/m/Y H:i', strtotime($amenity['created_at'])) }}</p>
                <p class="amenity-info"><strong>Cập nhật:</strong> {{ date('d/m/Y H:i', strtotime($amenity['updated_at'])) }}</p>
                
                <div class="card-actions">
                    <a href="/admin/amenities/detail/{{ $amenity['id'] }}" class="btn-sm btn-view">Chi tiết</a>
                    <a href="/admin/amenities/edit/{{ $amenity['id'] }}" class="btn-sm btn-edit">Sửa</a>
                    <!-- <a onclick="return confirm('Bạn có chắc muốn xóa tiện ích {{ $amenity['name'] }} không?')" 
                       href="/admin/amenities/delete/{{ $amenity['id'] }}" class="btn-sm btn-delete">Xóa</a> -->
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-message">
        <p>Không có tiện ích nào. Hãy thêm tiện ích mới!</p>
    </div>
    @endif
</div>
@endsection