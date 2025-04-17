@extends('admin.layout')

@section('title', 'Thêm Tiện ích')

@section('content')
<style>
    .create-container {
        margin: 50px 0;
        padding: 20px;
    }

    .create-form {
        background: #ffffff;
        border: 1px solid #ddd;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-group textarea {
        height: 150px;
        resize: vertical;
    }

    .btn-submit {
        background-color: #0064be;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .btn-submit:hover {
        background-color: #004a8e;
    }

    .btn-cancel {
        padding: 12px 20px;
        border: 1px solid #666;
        border-radius: 4px;
        text-decoration: none;
        color: #333;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .btn-cancel:hover {
        background-color: #f0f0f0;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    /* 🔥 THÊM CSS CHO THÔNG BÁO SESSION */
    .alert {
        padding: 12px;
        border-radius: 5px;
        font-size: 14px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 5px solid #dc3545;
    }
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 5px solid #28a745;
    }
    .alert .close {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        color: inherit;
    }
</style>

<div class="create-container">
    <h2>Thêm Tiện ích Mới</h2>

    @if(isset($_SESSION['error']))
        <div class="alert alert-error">
            <span>{{ $_SESSION['error'] }}</span>
            <button type="button" class="close" onclick="this.parentElement.style.display='none'">×</button>
        </div>
        @php unset($_SESSION['error']); @endphp
    @endif

    <form class="create-form" action="/admin/amenities/store" method="POST">
        <div class="form-group">
            <label for="name">Tên tiện ích:</label>
            <input type="text" id="name" name="name" value="{{ $_SESSION['old']['name'] ?? '' }}">
        </div>

        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea id="description" name="description">{{ $_SESSION['old']['description'] ?? '' }}</textarea>
        </div>

        <div class="form-group">
            <label for="icon">Icon (Font Awesome):</label>
            <input type="text" id="icon" name="icon" placeholder="Ví dụ: fas fa-wifi" value="{{ $_SESSION['old']['icon'] ?? '' }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn-submit">Lưu</button>
            <a href="/admin/amenities" class="btn-cancel">Hủy</a>
        </div>
    </form>
    <?php unset($_SESSION['old']); ?>
</div>
@endsection