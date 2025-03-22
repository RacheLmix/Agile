@extends('admin.layout')
@section('content')
    <style>
        /* Kiểu cơ bản cho bảng */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }

        /* Kiểu cho các ô tiêu đề */
        table th {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: 1px solid #dddddd;
            text-align: left;
        }

        /* Kiểu cho các hàng xen kẽ */
        table tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }

        /* Kiểu thông thường của các ô trong bảng */
        table td {
            padding: 10px;
            border: 1px solid #dddddd;
        }

        /* Kiểu khi di chuột qua các hàng (hover) */
        table tbody tr:hover {
            background-color: #e9ecef;
        }

        /* Kiểu cho liên kết nút EDIT */
        table td a {
            display: inline-block;
            background-color: #ffc107;
            color: #212529;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
        }

        table td a:hover {
            background-color: #e0a800;
        }

        /* Kiểu cho nút tạo tài khoản mới */
        a[href="/admin/users/create"] {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        a[href="/admin/users/create"]:hover {
            background-color: #218838;
        }
    </style>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Họ và tên</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Role</th>
        <th>status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user['id']}}</td>
            <td>{{$user['full_name']}}</td>
            <td>{{$user['email']}}</td>
            <td>{{$user['phone']}}</td>
            <td>{{$user['role']}}</td>
            <td>{{$user['status']}}</td>
            <td>
                <a href="/admin/users/edit/{{$user['id']}}">EDIT</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<a href="/admin/users/create">Tạo tài khoản mới</a>
@endsection