@extends('admin.layout')
@section('content')
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
            background-color: transparent;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.25rem;
            overflow: hidden;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            padding: 1rem;
            text-align: left;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
        }

        .table tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }

        .badge {
            padding: 0.4em 0.6em;
            font-size: 80%;
            font-weight: 500;
            border-radius: 0.25rem;
            text-transform: capitalize;
            display: inline-block;
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
            margin-right: 5px;
        }

        .btn-info {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8;
            transition: all 0.2s ease;
        }

        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }

        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
            transition: all 0.2s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .card {
            margin-top: 70px;
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            margin-bottom: 2rem;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            padding: 1.25rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            margin-bottom: 0;
            font-weight: 600;
            color: #343a40;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn-primary {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 0.25rem;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        @media (max-width: 992px) {
            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: 0.25rem;
            }

            .table tbody td {
                display: block;
                text-align: right;
                padding: 0.75rem;
                border-top: none;
                border-bottom: 1px solid #dee2e6;
            }

            .table tbody td:last-child {
                border-bottom: none;
            }

            .table tbody td:before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
                font-size: 0.85rem;
            }
        }
    </style>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quản lý khuyến mãi</h3>
                <div class="card-tools">
                    <a href="/admin/promotions/create" class="btn btn-primary">Thêm khuyến mãi mới</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Phòng</th>
                            <th>Tiêu đề</th>
                            <th>Giảm giá (%)</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promotions as $promotion)
                            <tr>
                                <td>{{ $promotion['id'] }}</td>
                                <td>{{ $promotion['room_id'] }}</td>
                                <td>{{ $promotion['title'] }}</td>
                                <td>{{ number_format($promotion['discount_percent'], 2, '.', '') }}%</td>
                                <td>{{ $promotion['start_date'] }}</td>
                                <td>{{ $promotion['end_date'] }}</td>
                                <td>
                                    <span class="badge badge-{{ $promotion['status'] == 'active' ? 'success' : 'danger' }}">
                                        {{ $promotion['status'] }}
                                    </span>
                                </td>
                                <td>
                                    <a href="/admin/promotions/edit/{{ $promotion['id'] }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/admin/promotions/delete/{{ $promotion['id'] }}" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Bạn có chắc muốn xóa?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection