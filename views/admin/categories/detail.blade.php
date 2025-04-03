@extends('admin.layout')
@section('content')
    <style>
        /* CSS cho container chính */
        .container {
            margin: 50px 0;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.08);
            transition: margin-left 0.3s, width 0.3s;
        }

        /* Tiêu đề */
        .title {
            color: #333;
            font-size: 20px;
            margin: 0 0 20px 0;
            font-weight: 600;
        }

        /* Thông tin chi tiết */
        .details {
            margin-top: 15px;
        }

        .details p {
            margin: 10px 0;
            font-size: 14px;
            color: #495057;
        }

        .details strong {
            color: #0064be; /* Màu xanh đồng bộ */
            font-weight: 600;
        }

        /* Nút Back */
        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            border: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #0064be;
            color: white;
        }

        /* Responsive cho màn hình nhỏ */
        @media (max-width: 992px) {
            .container {
                width: calc(100% - 40px);
                margin: 70px 20px 30px 20px;
            }
        }
    </style>

    <div class="container">
        <h1 class="title">Chi tiết</h1>
        <!-- Thông tin chi tiết -->
        <div class="details">
            <p><strong>Tên:</strong> {{ $category['name'] }}</p>
            <p><strong>Mô tả:</strong> {{ $category['description'] }}</p>
            <a href="/admin/categories" class="btn btn-primary">Quay lại</a>
        </div>
    </div>
@endsection