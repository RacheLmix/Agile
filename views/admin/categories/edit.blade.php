@extends('admin.layout')

@section('title', 'Thêm mới Danh Mục')

@section('content')
    <style>
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.08);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .form-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
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

        .btn {
            padding: 10px 16px;
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

        .btn-back {
            background-color: #ccc;
            color: black;
        }
    </style>

    <div class="form-container">
        <h2>Sửa Danh Mục</h2>

        @if(isset($_SESSION['error']))
            <div class="alert alert-error">
                <span>{{ $_SESSION['error'] }}</span>
                <button type="button" class="close" onclick="this.parentElement.style.display='none'">×</button>
            </div>
            @php unset($_SESSION['error']); @endphp
        @endif

        <form action="/admin/categories/update/{{$category['id']}}" method="POST">
            <div class="form-group">
                <label class="form-label">Tên danh mục</label>
                <input type="text" name="name" value="{{$category['name']}}" class="form-input" placeholder="Nhập tên danh mục">
            </div>

            <div class="form-group">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-input" placeholder="Nhập mô tả">{{$category['description']}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Sửa</button>
            <a href="/admin/categories" class="btn btn-back">Quay lại</a>
        </form>
    </div>
@endsection
