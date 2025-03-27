@extends('admin.layout')

@section('title', 'Thêm Tiện ích')

@section('content')
<div class="container" style="margin: 50px 0;">
    <h2>Thêm Tiện ích Mới</h2>
    <form action="/admin/amenities/store" method="POST">
        <div style="margin-bottom: 15px;">
            <label>Tên tiện ích:</label>
            <input type="text" name="name" required style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ddd;">
        </div>
        <div style="margin-bottom: 15px;">
            <label>Mô tả:</label>
            <textarea name="description" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ddd;"></textarea>
        </div>
        <div style="margin-bottom: 15px;">
            <label>Icon (Font Awesome):</label>
            <input type="text" name="icon" placeholder="Ví dụ: fas fa-wifi" style="width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ddd;">
        </div>
        <button type="submit" style="background-color: #0064be; color: white; padding: 10px 20px; border: none; border-radius: 4px;">Lưu</button>
        <a href="/admin/amenities" style="padding: 10px 20px; border: 1px solid #666; border-radius: 4px; text-decoration: none;">Hủy</a>
    </form>
</div>
@endsection