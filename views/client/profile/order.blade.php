@extends('client.profile.layout')

@section('content')
    <style>
        /* Main Container */
        .main-container {
            display: flex;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            min-height: calc(100vh - 170px);
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background-color: #fafafa;
            padding: 30px 20px;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-header i {
            color: #f59e0b;
            font-size: 24px;
        }

        .sidebar-header h1 {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
        }

        .sidebar .user-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding: 15px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .sidebar .user-name {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
        }

        .sidebar .user-email {
            font-size: 13px;
            color: #6b7280;
            word-break: break-all;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #4b5563;
            text-decoration: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar-nav a.active {
            background-color: #e3f2fd;
            color: #2563eb;
            font-weight: 600;
        }

        .sidebar-nav a:hover {
            background-color: #f1f5f9;
        }

        .sidebar-nav i {
            margin-right: 10px;
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .content {
            flex: 1;
            padding: 40px;
            background-color: #ffffff;
        }

        .profile-card {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .profile-card h2 {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 25px;
            text-align: center;
        }

        /* Filter and Search */
        .filter-search {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            gap: 15px;
        }

        .filter-select,
        .search-input {
            padding: 12px 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            color: #1f2937;
            background-color: #f9fafb;
            outline: none;
            transition: border-color 0.2s;
        }

        .filter-select {
            width: 220px;
        }

        .search-input {
            flex: 1;
            max-width: 300px;
        }

        .filter-select:focus,
        .search-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Booking Item */
        .booking-item {
            background-color: #f9fafb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            gap: 20px;
            align-items: center;
            transition: box-shadow 0.2s;
        }

        .booking-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .booking-item:last-child {
            margin-bottom: 0;
        }

        .booking-image {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .booking-content {
            flex: 1;
        }

        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .booking-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.5;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #d97706;
        }

        .status-confirmed {
            background-color: #d1fae5;
            color: #059669;
        }

        .status-cancelled {
            background-color: #fee2e2;
            color: #dc2626;
        }

        .status-completed {
            background-color: #dbeafe;
            color: #2563eb;
        }

        .booking-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 10px;
            margin-bottom: 15px;
        }

        .booking-info p {
            font-size: 14px;
            color: #6b7280;
            margin: 0;
        }

        .booking-info p span {
            color: #1f2937;
            font-weight: 500;
        }

        .booking-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }

        .total-price {
            font-size: 16px;
            font-weight: 600;
            color: #2563eb;
        }

        .button-container {
            display: flex;
            gap: 12px;
        }

        .action-button {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: background-color 0.2s;
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .view-button {
            background-color: #6b7280;
            color: #ffffff;
        }

        .view-button:hover {
            background-color: #4b5563;
        }

        .cancel-button {
            background-color: #dc2626;
            color: #ffffff;
        }

        .cancel-button:hover {
            background-color: #b91c1c;
        }

        .checkin-button {
            background-color: #2563eb;
            color: #ffffff;
        }

        .checkin-button:hover {
            background-color: #1d4ed8;
        }

        .action-button i {
            font-size: 14px;
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            background-color: #f9fafb;
            border-radius: 12px;
        }

        .empty-state p {
            font-size: 16px;
            color: #6b7280;
            margin-bottom: 25px;
        }

        .explore-button {
            background-color: #2563eb;
            color: #ffffff;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: background-color 0.2s;
            display: inline-block;
        }

        .explore-button:hover {
            background-color: #1d4ed8;
        }

        /* Responsive Adjustments for Main Content */
        @media (max-width: 992px) {
            .main-container {
                flex-direction: column;
                margin: 15px;
                min-height: auto;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #e5e7eb;
            }

            .content {
                padding: 30px;
            }

            .profile-card {
                max-width: 100%;
            }

            .filter-search {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-select,
            .search-input {
                width: 100%;
                max-width: none;
            }
        }

        @media (max-width: 576px) {
            .content {
                padding: 20px;
            }

            .profile-card {
                padding: 20px;
            }

            .profile-card h2 {
                font-size: 20px;
            }

            .booking-item {
                flex-direction: column;
                align-items: flex-start;
                padding: 15px;
            }

            .booking-image {
                width: 100%;
                height: 120px;
            }

            .booking-header h3 {
                font-size: 16px;
            }

            .status-badge {
                font-size: 12px;
                padding: 5px 10px;
            }

            .booking-info {
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .action-button {
                padding: 8px 15px;
                font-size: 13px;
            }

            .explore-button {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
    </style>
        <!-- Main Content -->
        <div class="content">
            <div class="profile-card">
                <h2>Lịch sử đặt phòng</h2>

                @if(empty($bookings))
                    <div class="empty-state">
                        <p>Bạn chưa có đơn đặt phòng nào. Hãy khám phá các homestay tuyệt vời!</p>
                        <a href="/" class="explore-button">Khám phá ngay</a>
                    </div>
                @else
                    <div class="filter-search">
                        <select depositing class="filter-select" onchange="filterBookings(this.value)">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending">Đang chờ xác nhận</option>
                            <option value="confirmed">Đã xác nhận</option>
                            <option value="cancelled">Đã hủy</option>
                            <option value="completed">Hoàn thành</option>
                        </selecting>
                        <input type="text" class="search-input" placeholder="Tìm theo homestay hoặc phòng..." oninput="searchBookings(this.value)">
                    </div>

                    <div id="booking-list">
                        @foreach($bookings as $booking)
                            <div class="booking-item" data-status="{{ $booking['status'] }}" data-search="{{ strtolower($booking['homestay_name'] . ' ' . $booking['room_name']) }}">
                                <img src="{{ $booking['homestay_image'] ?? 'https://via.placeholder.com/120x80' }}" alt="Homestay" class="booking-image">
                                <div class="booking-content">
                                    <div class="booking-header">
                                        <h3>{{ $booking['homestay_name'] }} - {{ $booking['room_name'] }}</h3>
                                        <span class="status-badge 
                                            @if($booking['status'] == 'pending') status-pending
                                            @elseif($booking['status'] == 'confirmed') status-confirmed
                                            @elseif($booking['status'] == 'cancelled') status-cancelled
                                            @elseif($booking['status'] == 'completed') status-completed
                                            @endif">
                                            @if($booking['status'] == 'pending')
                                                Đang chờ xác nhận
                                            @elseif($booking['status'] == 'confirmed')
                                                Đã xác nhận
                                            @elseif($booking['status'] == 'cancelled')
                                                Đã hủy
                                            @elseif($booking['status'] == 'completed')
                                                Hoàn thành
                                            @else
                                                {{ $booking['status'] }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="booking-info">
                                        <p>Check-in: <span>{{ date('d/m/Y', strtotime($booking['check_in'])) }}</span></p>
                                        <p>Check-out: <span>{{ date('d/m/Y', strtotime($booking['check_out'])) }}</span></p>
                                        <p>Tổng tiền: <span>{{ number_format($booking['total_price'], 0, ',', '.') }} VND</span></p>
                                    </div>
                                    <div class="booking-footer">
                                        <p class="total-price">Mã đơn: #{{ $booking['id'] }}</p>
                                        <div class="button-container">
                                            <a href="/orderview/detail/{{ $booking['id'] }}" class="action-button view-button">
                                                <i class="fas fa-eye"></i> Xem chi tiết
                                            </a>
                                            @if($booking['status'] == 'pending')
                                                <button class="action-button cancel-button" onclick="cancelBooking({{ $booking['id'] }})">
                                                    <i class="fas fa-times"></i> Hủy
                                                </button>
                                            @endif
                                            @if($booking['status'] == 'confirmed')
                                                <button class="action-button checkin-button" onclick="checkIn({{ $booking['id'] }})">
                                                    <i class="fas fa-check"></i> Check-in
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination (nếu có) -->
                    @if(isset($pagination) && $pagination['total_pages'] > 1)
                        <div class="pagination">
                            @for($i = 1; $i <= $pagination['total_pages']; $i++)
                                <a href="/orderview?page={{ $i }}" class="{{ $i == $pagination['current_page'] ? 'active' : '' }}">{{ $i }}</a>
                            @endfor
                        </div>
                    @endif
                @endif
            </div>
        </div>

    <script>
        function cancelBooking(bookingId) {
            if (confirm('Bạn có chắc chắn muốn hủy đặt phòng này không?')) {
                window.location.href = '/cancel/' + bookingId;
            }
        }

        function checkIn(bookingId) {
            if (confirm('Xác nhận bạn đã đến và check-in?')) {
                window.location.href = '/checkin/' + bookingId;
            }
        }

        function filterBookings(status) {
            const items = document.querySelectorAll('.booking-item');
            items.forEach(item => {
                const itemStatus = item.getAttribute('data-status');
                item.style.display = (status === '' || itemStatus === status) ? '' : 'none';
            });
        }

        function searchBookings(query) {
            const items = document.querySelectorAll('.booking-item');
            const searchTerm = query.toLowerCase();
            items.forEach(item => {
                const searchData = item.getAttribute('data-search');
                item.style.display = searchData.includes(searchTerm) ? '' : 'none';
            });
        }
    </script>
@endsection