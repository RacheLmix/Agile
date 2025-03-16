@extends('admin.layout')
@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f8f8f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .product-container {
            display: flex;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            max-width: 700px;
        }
        .product-info {
            margin-left: 20px;
        }

        .product-title {
            font-size: 24px;
            color: #333;
        }
        .product-price span {
            color: red;
            font-weight: bold;
        }
        .product-description {
            margin: 10px 0;
        }
        .buy-button {
            background: #ff4d00;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.3s;
        }
        .buy-button:hover {
            background: #e60000;
        }
    </style>
<div class="product-container">
    <div class="product-info">
        @if($booking['user_id'] == $users['id'])
            <h1 class="product-title">{{$users['full_name']}}</h1>
        @endif
        <p class="product-price">Giá: <span>{{$booking['total_price']}}</span></p>
        <p><span>{{$booking['check_in']}}</span></p>
        <p><span>{{$booking['check_out']}}</span></p>
        <p class="product-description">
            Đây là một chiếc laptop gaming mạnh mẽ với CPU Intel Core i7, RAM 16GB, SSD 512GB.
        </p>
    </div>
</div>
@endsection