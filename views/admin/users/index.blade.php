@extends('admin.layout')
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
        
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f8f9fa;
        }
        
        .status {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-active {
            background-color: #e6f7ee;
            color: #00b74a;
        }
        
        .status-inactive {
            background-color: #fff8e6;
            color: #e6a700;
        }
        
        .status-banned {
            background-color: #feeaec;
            color: #f44336;
        }
        
        .action-cell {
            display: flex;
            gap: 8px;
        }
        
        .btn-sm {
            padding: 4px 8px;
            font-size: 12px;
            border-radius: 4px;
        }
        
        .btn-info {
            background-color: #0064be;
            color: white;
        }
        
        .btn-warning {
            background-color: #ff9800;
            color: white;
        }
        
        .empty-message {
            text-align: center;
            padding: 30px;
            color: #666;
        }
        
        .role-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .role-admin {
            background-color: #e6f7ee;
            color: #00b74a;
        }
        
        .role-user {
            background-color: #e8f4f8;
            color: #0064be;
        }
        
        .role-guest {
            background-color: #f8f9fa;
            color: #6c757d;
        }
    </style>

    <div class="table-container">
        <div class="table-header">
            <h2>Quản lý người dùng</h2>
            <div class="action-buttons">
                <a href="/admin/users/create" class="btn btn-primary">Tạo tài khoản mới</a>
            </div>
        </div>
        
        @if(count($users) > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ và tên</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user['id']}}</td>
                        <td>{{$user['full_name']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>{{$user['phone']}}</td>
                        <td>
                            <span class="role-badge role-{{strtolower($user['role'])}}">
                                {{$user['role']}}
                            </span>
                        </td>
                        <td>
                            <span class="status status-{{strtolower($user['status'])}}">
                                {{ $user['status'] == 'active' ? 'Hoạt động' : 
                                   ($user['status'] == 'inactive' ? 'Không hoạt động' : 'Đã khóa') }}
                            </span>
                        </td>
                        <td class="action-cell">
                            <a href="/admin/users/edit/{{$user['id']}}" class="btn-sm btn-warning">EDIT</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-message">
            <p>Không có người dùng nào.</p>
        </div>
        @endif
    </div>
@endsection