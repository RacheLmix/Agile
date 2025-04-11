


@section('title', 'Lịch sử đặt phòng')

<style>
    .orders-container {
        max-width: 1000px;
        margin: 30px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    }
    
    /* Add this new style for the home button */
    .btn-home {
        padding: 8px 15px;
        background-color: #ff5e1f;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        transition: background-color 0.3s;
    }
    
    .btn-home i {
        margin-right: 5px;
    }
    
    .btn-home:hover {
        background-color: #e04e15;
        color: white;
    }
    
    .user-welcome {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eaeaea;
    }
    
    .user-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #0770cd;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
        margin-right: 15px;
    }
    
    .user-info {
        flex: 1;
    }
    
    .user-name {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin: 0;
    }
    
    .user-bookings-count {
        font-size: 14px;
        color: #666;
        margin: 5px 0 0 0;
    }
    
    .page-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 20px;
        color: #333;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 10px;
    }
    
    .booking-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .booking-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .booking-header {
        background-color: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .booking-id {
        font-weight: 600;
        color: #555;
    }
    
    .booking-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }
    
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .status-confirmed {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-cancelled {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .status-completed {
        background-color: #cce5ff;
        color: #004085;
    }
    
    .booking-body {
        padding: 25px;
    }
    
    /* Add these styles for the collapsible animation */
    .booking-details {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        overflow: hidden;
        transition: max-height 0.4s ease-in-out;
        max-height: 500px;
    }
    
    .booking-details.collapsed {
        max-height: 0;
    }
    
    .toggle-details {
        cursor: pointer;
        color: #0770cd;
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        font-weight: 600;
    }
    
    .toggle-details i {
        margin-right: 8px;
        transition: transform 0.3s ease;
    }
    
    .toggle-details.active i {
        transform: rotate(180deg);
    }
    
    .booking-detail {
        margin-bottom: 15px;
    }
    
    .detail-label {
        font-weight: 600;
        color: #666;
        margin-bottom: 5px;
        font-size: 14px;
    }
    
    .detail-value {
        color: #333;
        font-size: 16px;
    }
    
    .booking-price {
        margin-top: 25px;
        padding-top: 15px;
        border-top: 1px solid #eee;
        text-align: right;
        font-size: 20px;
        font-weight: 700;
        color: #0770cd;
    }
    
    .booking-actions {
        padding: 15px 20px;
        background-color: #f8f9fa;
        border-top: 1px solid #eee;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }
    
    .btn-action {
        padding: 10px 18px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        transition: all 0.3s;
        font-size: 14px;
    }
    
    .btn-view {
        background-color: #0770cd;
        color: white;
    }
    
    .btn-view:hover {
        background-color: #0561b0;
    }
    
    .btn-cancel {
        background-color: #dc3545;
        color: white;
    }
    
    .btn-cancel:hover {
        background-color: #c82333;
    }
    
    .no-bookings {
        text-align: center;
        padding: 60px 0;
        color: #666;
    }
    
    .no-bookings p {
        margin-bottom: 20px;
        font-size: 18px;
    }
    
    .no-bookings a {
        display: inline-block;
        padding: 12px 24px;
        background-color: #0770cd;
        color: white !important;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        transition: background-color 0.3s;
    }
    
    .no-bookings a:hover {
        background-color: #0561b0;
    }
    
    @media (max-width: 768px) {
        .booking-details {
            grid-template-columns: 1fr;
        }
        
        .orders-container {
            margin: 15px;
            padding: 15px;
        }
    }
</style>

<div class="orders-container">
    <div class="user-welcome">
        <div class="user-avatar">
            {{ substr($_SESSION['user']['full_name'] ?? 'U', 0, 1) }}
        </div>
        <div class="user-info">
            <h2 class="user-name">{{ $_SESSION['user']['full_name'] ?? 'Khách hàng' }}</h2>
            <p class="user-bookings-count">
                {{ count($bookings) }} đơn đặt phòng
            </p>
        </div>
        <a href="/" class="btn-home">
            <i class="fas fa-home"></i> Trang chủ
        </a>
    </div>

    <h1 class="page-title">Lịch sử đặt phòng</h1>
    
    @if(empty($bookings))
        <div class="no-bookings">
            <p>Bạn chưa có đơn đặt phòng nào.</p>
            <a href="/">Khám phá các homestay</a>
        </div>
    @else
        @foreach($bookings as $booking)
            <div class="booking-card">
                <div class="booking-header">
                    <div class="booking-id">Đơn đặt phòng #{{ $booking['id'] }}</div>
                    <div class="booking-status status-{{ strtolower($booking['status']) }}">
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
                    </div>
                </div>
                
                <!-- In the booking-body section -->
                <div class="booking-body">
                    <div class="toggle-details" onclick="toggleBookingDetails({{ $booking['id'] }})">
                        <i class="fas fa-chevron-down" id="toggle-icon-{{ $booking['id'] }}"></i>
                        <span id="toggle-text-{{ $booking['id'] }}">Xem chi tiết đơn đặt phòng</span>
                    </div>
                    
                    <div class="booking-details collapsed" id="booking-details-{{ $booking['id'] }}">
                        <div class="booking-detail">
                            <div class="detail-label">Người đặt</div>
                            <div class="detail-value">{{ $_SESSION['user']['full_name'] ?? 'Không có thông tin' }}</div>
                        </div>
                        
                        <div class="booking-detail">
                            <div class="detail-label">Email</div>
                            <div class="detail-value">{{ $_SESSION['user']['email'] ?? 'Không có thông tin' }}</div>
                        </div>
                        
                        <div class="booking-detail">
                            <div class="detail-label">Homestay</div>
                            <div class="detail-value">{{ $booking['homestay_name'] }}</div>
                        </div>
                        
                        <div class="booking-detail">
                            <div class="detail-label">Phòng</div>
                            <div class="detail-value">{{ $booking['room_name'] }}</div>
                        </div>
                        
                        <div class="booking-detail">
                            <div class="detail-label">Ngày nhận phòng</div>
                            <div class="detail-value">{{ date('d/m/Y', strtotime($booking['check_in'])) }}</div>
                        </div>
                        
                        <div class="booking-detail">
                            <div class="detail-label">Ngày trả phòng</div>
                            <div class="detail-value">{{ date('d/m/Y', strtotime($booking['check_out'])) }}</div>
                        </div>
                        
                        <div class="booking-detail">
                            <div class="detail-label">Số đêm</div>
                            <div class="detail-value">{{ $booking['nights'] }}</div>
                        </div>
                        
                        <div class="booking-detail">
                            <div class="detail-label">Số khách</div>
                            <div class="detail-value">{{ $booking['guests'] }}</div>
                        </div>
                        
                        <div class="booking-detail">
                            <div class="detail-label">Ngày đặt</div>
                            <div class="detail-value">{{ date('d/m/Y H:i', strtotime($booking['created_at'])) }}</div>
                        </div>
                    </div>
                    
                    <div class="booking-price">
                        Tổng tiền: {{ number_format($booking['total_price'], 0, ',', '.') }} VND
                    </div>
                </div>
                
                <div class="booking-actions">
                    @if($booking['status'] == 'pending')
                        <button class="btn-action btn-cancel" onclick="cancelBooking({{ $booking['id'] }})">Hủy đặt phòng</button>
                    @endif
                    <button class="btn-action btn-view" onclick="checkIn({{ $booking['id'] }})">Đã đến checkin</button>
                </div>
            </div>
        @endforeach
    @endif
</div>
<script>
    function cancelBooking(bookingId) {
        if (confirm('Bạn có chắc chắn muốn hủy đặt phòng này không?')) {
            window.location.href = '/cancel/' + bookingId;
        }
    }
    function toggleBookingDetails(bookingId) {
        const detailsElement = document.getElementById('booking-details-' + bookingId);
        const toggleElement = document.getElementById('toggle-icon-' + bookingId);
        const toggleText = document.getElementById('toggle-text-' + bookingId);
        if (detailsElement.classList.contains('collapsed')) {
            detailsElement.classList.remove('collapsed');
            toggleElement.parentElement.classList.add('active');
            toggleText.textContent = 'Ẩn chi tiết đơn đặt phòng';
        } else {
            detailsElement.classList.add('collapsed');
            toggleElement.parentElement.classList.remove('active');
            toggleText.textContent = 'Xem chi tiết đơn đặt phòng';
        }
    }
    function checkIn(bookingId) {
    if (confirm('Xác nhận bạn đã đến và checkin?')) {
        window.location.href = '/checkin/' + bookingId;
    }
}
</script>
