@extends('admin.layout')

@section('title', 'Quản lý Homestay')

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
    
    .homestay-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    
    .homestay-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .homestay-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .homestay-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }
    
    .homestay-details {
        padding: 15px;
        position: relative;
    }
    
    .homestay-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin: 0 0 10px 0;
    }
    
    .homestay-info {
        margin-bottom: 8px;
        font-size: 14px;
        color: #666;
    }
    
    .homestay-info strong {
        color: #333;
    }
    
    .truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .rating {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }
    
    .rating-value {
        font-weight: 600;
        color: #0064be;
        margin-right: 5px;
    }
    
    .rating-stars {
        color: #ffc107;
    }
    
    .category-badge {
        display: inline-block;
        background-color: #e8f4f8;
        color: #0064be;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 12px;
    }
    
    .status-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        margin-bottom: 12px;
    }
    
    .status-active {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-inactive {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .status-blocked {
        background-color: #d6d8d9;
        color: #383d41;
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
    .id {
        position: absolute;
        right: 0;
        padding: 10px;
        font-size: 30px;
        transition: all ease-in-out 0.25s;
    }
    .homestay-card:hover .id {
        right: 50px;
        font-size: 40px;
    }
</style>
<div class="table-container">
    <div class="table-header">
        <h2>Quản lý Homestay</h2>
        <div class="action-buttons">
            <a href="/admin/homestays/create" class="btn btn-primary">Thêm mới Homestay</a>
        </div>
    </div>
    
    @if(count($homestays) > 0)
    <div class="homestay-grid">
        @foreach($homestays as $homestay)
        <div class="homestay-card">
            <img src="{{ file_url($homestay['image']) }}" alt="{{ $homestay['name'] }}" class="homestay-image">
            <div class="homestay-details">
                <h3 class="homestay-title">{{ $homestay['name'] }}</h3>
                <h2 class="id">{{ $homestay['id'] }}</h2>
                <div class="category-badge">{{ $homestay['category_name'] }}</div>
                <div class="status-badge status-{{ $homestay['status'] }}">
                    @if($homestay['status'] == 'active')
                        Hoạt động
                    @elseif($homestay['status'] == 'inactive')
                        Đang xét duyệt
                    @elseif($homestay['status'] == 'pending')
                        Đang bảo trì
                    @elseif($homestay['status'] == 'blocked')
                        Đã bị chặn
                    @endif
                </div>
                
                <div class="rating">
                    <span class="rating-value">{{ $homestay['rating'] }}</span>
                    <div class="rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= round($homestay['rating']))
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                </div>
                
                <p class="homestay-info"><strong>Vị trí:</strong> {{ $homestay['location'] }}</p>
                <p class="homestay-info"><strong>Địa chỉ:</strong> {{ $homestay['address'] }}</p>
                <p class="homestay-info truncate"><strong>Mô tả:</strong> {{ $homestay['description'] }}</p>
                
                <div class="card-actions">
                    <a href="/admin/homestays/detail/{{ $homestay['id'] }}" class="btn-sm btn-view">Chi tiết</a>
                    <a href="/admin/homestays/edit/{{ $homestay['id'] }}" class="btn-sm btn-edit">Sửa</a>
                    <a onclick="return confirm('Bạn có chắc muốn xóa homestay {{ $homestay['name'] }} không?')"
                       href="/admin/homestays/delete/{{ $homestay['id'] }}" class="btn-sm btn-delete">Xóa</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-message">
        <p>Không có homestay nào. Hãy thêm homestay mới!</p>
    </div>
    @endif
</div>
@endsection