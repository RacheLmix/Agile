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
    padding: 1.5rem;
    max-width: 1400px;
    margin: 0 auto;
}

/* Thiết kế Card */
.card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 1.5rem;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.15);
}

.card-header {
    padding: 1rem 1.25rem;
    background-color: #fff;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header h6 {
    margin: 0;
    font-weight: 600;
    font-size: 0.95rem;
    color: #3a3a3a;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.card-body {
    padding: 1.25rem;
}

/* Card thống kê */
.stats-card {
    position: relative;
    color: #fff;
    overflow: hidden;
}

.stats-card.primary-card {
    background: linear-gradient(45deg, #4568dc, #3f51b5);
}

.stats-card.success-card {
    background: linear-gradient(45deg, #43a047, #66bb6a);
}

.stats-card.info-card {
    background: linear-gradient(45deg, #03a9f4, #29b6f6);
}

.stats-card.warning-card {
    background: linear-gradient(45deg, #ff9800, #ffb74d);
}

.stats-card.danger-card {
    background: linear-gradient(45deg, #e53935, #f44336);
}

.stats-value {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0.5rem 0;
}

.text-xs {
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}

/* Icon Container */
.icon-container {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.2);
    font-size: 1.4rem;
    transition: all 0.3s;
}

.icon-container:hover {
    transform: rotate(10deg);
    background: rgba(255, 255, 255, 0.3);
}

/* Bảng */
.table-responsive {
    border-radius: 8px;
    overflow: hidden;
}

.table {
    width: 100%;
    margin-bottom: 0;
    color: #333;
    border-collapse: collapse;
}

.table th {
    background-color: #f8f9fa;
    color: #3a3a3a;
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    padding: 0.85rem 1rem;
    border-bottom: 2px solid rgba(0, 0, 0, 0.05);
}

.table td {
    padding: 0.85rem 1rem;
    vertical-align: middle;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.02);
}

/* Badges */
.badge {
    display: inline-block;
    padding: 0.35em 0.65em;
    font-size: 0.75rem;
    font-weight: 500;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 50px;
}

.badge-success {
    background-color: #4caf50;
    color: #fff;
}

.badge-warning {
    background-color: #ff9800;
    color: #fff;
}

.badge-danger {
    background-color: #f44336;
    color: #fff;
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
    color: #ffb400;
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

.col-xl-3 {
    flex: 0 0 100%;
    max-width: 100%;
}

.col-xl-6, .col-lg-6, .col-xl-12, .col-lg-12 {
    flex: 0 0 100%;
    max-width: 100%;
}

/* Media Queries */
@media (min-width: 768px) {
    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

@media (min-width: 992px) {
    .col-lg-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
    
    .col-lg-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}

@media (min-width: 1200px) {
    .col-xl-3 {
        flex: 0 0 25%;
        max-width: 25%;
    }
    
    .col-xl-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }
    
    .col-xl-12 {
        flex: 0 0 100%;
        max-width: 100%;
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

.mr-1 {
    margin-right: 0.25rem;
}

.mr-2 {
    margin-right: 0.5rem;
}

.mt-1 {
    margin-top: 0.25rem;
}

.py-3 {
    padding-top: 1rem;
    padding-bottom: 1rem;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.card {
    animation: fadeIn 0.5s ease-in-out;
}
    </style>

    <div class="dashboard-container">
        <div class="container-fluid">
            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stats-card primary-card">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <i class="fas fa-users mr-1"></i> Total Users
                                    </div>
                                    <div class="stats-value">{{ $totalUsers }}</div>
                                    
                                </div>
                                <div class="col-auto">
                                    <div class="icon-container bg-primary">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stats-card success-card">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Bookings</div>
                                    <div class="stats-value">{{ $totalBookings }}</div>
                                </div>
                                <div class="col-auto">
                                    <div class="icon-container bg-success">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stats-card info-card">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Homestays</div>
                                    <div class="stats-value">{{ $totalHomestays }}</div>
                                </div>
                                <div class="col-auto">
                                    <div class="icon-container bg-info">
                                        <i class="fas fa-home"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stats-card warning-card">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Revenue</div>
                                    <div class="stats-value">${{ number_format($totalRevenue, 2) }}</div>
                                </div>
                                <div class="col-auto">
                                    <div class="icon-container bg-warning">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">
                <!-- Recent Bookings -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Recent Bookings</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Room</th>
                                            <th>Check In</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentBookings as $booking)
                                            <tr>
                                                <td>{{ $booking['user_name'] }}</td>
                                                <td>{{ $booking['room_name'] }}</td>
                                                <td>{{ $booking['check_in'] ? date('M d, Y', strtotime($booking['check_in'])) : 'N/A' }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $booking['status'] == 'completed' ? 'success' : ($booking['status'] == 'pending' ? 'warning' : 'danger') }}">
                                                        {{ $booking['status'] ? ucfirst($booking['status']) : 'Unknown' }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Rated Homestays -->
                <div class="col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Top Rated Homestays</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Rating</th>
                                            <th>Category</th>
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

            <!-- Booking Statistics -->
            <!-- <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Booking Statistics</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($bookingStats as $stat)
                                    <div class="col-xl-3 col-md-6 mb-4">
                                        <div class="card stats-card {{ $stat['status'] == 'completed' ? 'success-card' : ($stat['status'] == 'pending' ? 'warning-card' : 'danger-card') }}">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div class="text-xs font-weight-bold text-{{ $stat['status'] == 'completed' ? 'success' : ($stat['status'] == 'pending' ? 'warning' : 'danger') }} text-uppercase mb-1">
                                                            {{ $stat['status'] ? ucfirst($stat['status']) : 'Unknown' }} Bookings
                                                        </div>
                                                        <div class="stats-value">{{ $stat['count'] }}</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="icon-container bg-{{ $stat['status'] == 'completed' ? 'success' : ($stat['status'] == 'pending' ? 'warning' : 'danger') }}">
                                                            <i class="fas fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
@endsection