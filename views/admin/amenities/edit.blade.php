@extends('admin.layout')

@section('title', 'Chi tiết Tiện ích')

@section('content')
<div class="container" style="margin: 50px 0;">
    <h2>Chi tiết Tiện ích: {{ $amenity['name'] }}</h2>
    <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
        <p><strong>Tên:</strong> {{ $amenity['name'] }}</p>
        <p><strong>Mô tả:</strong> {{ $amenity['description'] ?? 'Không có mô tả' }}</p>
        <p><strong>Icon:</strong> <i class="{{ $amenity['icon'] }}"></i> ({{ $amenity['icon'] }})</p>
        <p><strong>Ngày tạo:</strong> {{ date('d/m/Y H:i', strtotime($amenity['created_at'])) }}</p>
        <p><strong>Cập nhật:</strong> {{ date('d/m/Y H:i', strtotime($amenity['updated_at'])) }}</p>
        <a href="/admin/amenities" style="background-color: #0064be; color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none;">Quay lại</a>
    </div>
</div>
@endsection