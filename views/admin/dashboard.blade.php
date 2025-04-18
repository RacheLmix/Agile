@extends('admin.layout')

@section('content')
<style>
    /* Reset và Thiết lập cơ bản */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Roboto', 'Helvetica Neue', sans-serif;
        background-color: #f5f7fa;
        color: #333;
        line-height: 1.6;
    }

    /* Container chính */
    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Thiết kế Card thống kê */
    .table-container {
        margin: 50px 0;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.08);
        transition: margin-left 0.3s, width 0.3s;
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

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .stats-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
        padding: 15px;
        position: relative;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .stats-card.primary-card {
        border-left: 4px solid #0064be;
        background: #0064be;
    }

    .stats-card.success-card {
        border-left: 4px solid #00b74a;
        background: #00b74a;
    }

    .stats-card.info-card {
        border-left: 4px solid #03a9f4;
        background: #03a9f4;
    }

    .stats-card.warning-card {
        border-left: 4px solid #ff9800;
        background: #ff9800;
    }

    .stats-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: #333;
        margin: 0.5rem 0;
    }

    .stats-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #000;
        text-transform: uppercase;
    }

    .icon-container {
        position: absolute;
        top: 15px;
        right: 15px;
        width: 40px;
        height: 40px;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        font-size: 1.2rem;
        color: #666;
    }

    /* Bảng */
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

    /* Badges */
    .status {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-completed {
        background-color: #e6f7ee;
        color: #00b74a;
    }

    .status-pending {
        background-color: #fff8e6;
        color: #e6a700;
    }

    .status-cancelled {
        background-color: #feeaec;
        color: #f44336;
    }

    /* Rating stars */
    .rating {
        display: flex;
        align-items: center;
    }

    .rating i {
        color: #ddd;
        margin-right: 2px;
    }

    .rating i.active {
        color: #ff9800;
    }

    /* Grid Layout */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -0.75rem;
        margin-left: -0.75rem;
    }

    [class*="col-"] {
        position: relative;
        width: 100%;
        padding-right: 0.75rem;
        padding-left: 0.75rem;
    }

    /* Responsive columns */
    .col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .col-xl-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    @media (min-width: 768px) {
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    @media (min-width: 1200px) {
        .col-xl-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }

    /* Utilities */
    .d-flex {
        display: flex;
    }

    .align-items-center {
        align-items: center;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .text-uppercase {
        text-transform: uppercase;
    }

    .font-weight-bold {
        font-weight: 700;
    }

    .m-0 {
        margin: 0;
    }

    .mb-1 {
        margin-bottom: 0.25rem;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    /* Kiểu cho màn hình nhỏ */
    @media (max-width: 992px) {
        .table-container {
            width: calc(100% - 40px);
            margin: 70px 20px 30px 20px;
        }
    }
</style>

<div class="dashboard-container">
    <div class="container-fluid">
        <!-- Statistics Cards -->
        <div class="table-container">
            <div class="table-header">
                <h2>Thống kê tổng quan</h2>
            </div>
            <div class="stats-grid">
                <div class="stats-card primary-card">
                    <div class="stats-label"><i class="fas fa-users mr-1"></i> Tổng người dùng</div>
                    <div class="stats-value">{{ $totalUsers }}</div>
                    <div class="icon-container">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stats-card success-card">
                    <div class="stats-label"><i class="fas fa-calendar-check mr-1"></i> Tổng đặt phòng</div>
                    <div class="stats-value">{{ $totalBookings }}</div>
                    <div class="icon-container">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
                <div class="stats-card info-card">
                    <div class="stats-label"><i class="fas fa-home mr-1"></i> Tổng homestay</div>
                    <div class="stats-value">{{ $totalHomestays }}</div>
                    <div class="icon-container">
                        <i class="fas fa-home"></i>
                    </div>
                </div>
                <div class="stats-card warning-card">
                    <div class="stats-label"><i class="fas fa-dollar-sign mr-1"></i> Tổng doanh thu</div>
                    <div class="stats-value">{{ number_format($totalRevenue, 0, ',', '.') }} VND</div>
                    <div class="icon-container">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Recent Bookings -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="table-container">
                    <div class="table-header">
                        <h2>Đặt phòng gần đây</h2>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Người dùng</th>
                                <th>Phòng</th>
                                <th>Check In</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBookings as $booking)
                                <tr>
                                    <td>{{ $booking['user_name'] }}</td>
                                    <td>{{ $booking['room_name'] }}</td>
                                    <td>{{ $booking['check_in'] ? date('d/m/Y', strtotime($booking['check_in'])) : 'N/A' }}</td>
                                    <td>
                                        <span class="status status-{{ strtolower($booking['status']) }}">
                                            {{ $booking['status'] == 'completed' ? 'Hoàn thành' : 
                                               ($booking['status'] == 'pending' ? 'Đang chờ' : 'Đã hủy') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Rated Homestays -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="table-container">
                    <div class="table-header">
                        <h2>Homestay được đánh giá cao</h2>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Vị trí</th>
                                <th>Đánh giá</th>
                                <th>Danh mục</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topRatedHomestays as $homestay)
                                <tr>
                                    <td>{{ $homestay['name'] }}</td>
                                    <td>{{ $homestay['location'] }}</td>
                                    <td>
                                        <div class="rating">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= ($homestay['rating'] ?? 0) ? 'active' : '' }}"></i>
                                            @endfor
                                        </div>
                                    </td>
                                    <td>{{ $homestay['category_name'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection