@extends('admin.layout')
@section('content')
    <div class="status-container">
        <p>Trạng thái hiện tại của tài khoản: <strong>{{ ucfirst($users['status']) }}</strong></p>

        <form action="/admin/users/update/{{ $users['id'] }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $users['id'] }}">
            <div>
                <label>Full name</label>
                <input type="text" disabled value="{{ $users['full_name'] }}">
            </div>
            <div>
                <label>Email</label>
                <input type="email" disabled value="{{ $users['email'] }}">
            </div>
            <div>
                <label>Phone</label>
                <input type="text" disabled value="{{ $users['phone'] }}">
            </div>

            <label for="status">Chọn trạng thái:</label>
            <select id="status" name="status">
                @if($users['status'] === 'active')
                    <option value="inactive">Inactive</option>
                @elseif($users['status'] === 'inactive')
                    <option value="banned">Banned</option>
                @elseif($users['status'] === 'banned')
                    <option disabled>Tài Khoản Đã Bị Cấm Vui lòng Liên Hệ Quản Trị Viên</option>
                @else
                    <option disabled>Không thể thay đổi tiếp</option>
                @endif
            </select>
            <button type="submit" {{ $users['status'] === 'banned' ? '' : '' }}>Cập nhật</button>
        </form>
    </div>

    <style>
        .status-container {
            max-width: 500px;
            margin: 40px auto;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #ddd;
            background: #fcfcfc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        /* Style cho các nhãn và input */
        .status-container label {
            margin-top: 15px;
            font-weight: bold;
            color: #555;
        }

        .status-container input[disabled] {
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            color: #888;
        }

        /* Style chung cho input và select */
        .status-container input,
        .status-container select {
            display: block;
            width: 100%;
            padding: 8px 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            transition: border .3s ease-in-out, box-shadow .3s ease-in-out;
        }

        .status-container input:focus,
        .status-container select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 5px rgba(59, 130, 246, 0.4);
        }

        /* Style nút submit */
        .status-container button {
            margin-top: 25px;
            padding: 10px 20px;
            background-color: #3b82f6;
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background .3s ease;
        }

        .status-container button:hover {
            background-color: #2563eb;
        }

        .status-container button:disabled {
            background-color: #bbb;
            cursor: not-allowed;
        }
    </style>
@endsection