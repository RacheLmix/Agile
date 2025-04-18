@extends('admin.layout')
@section('content')
<style>
    /* CSS cho container chính */
    .booking-container {
        margin: 50px 0;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.08);
        transition: margin-left 0.3s, width 0.3s;
    }

    /* Tiêu đề */
    .booking-title {
        color: #333;
        font-size: 20px;
        margin: 0 0 20px 0;
        font-weight: 600;
        text-align: center;
    }

    /* Thông tin chi tiết */
    .booking-info {
        margin-top: 15px;
    }

    .booking-info p {
        margin: 10px 0;
        font-size: 14px;
        color: #495057;
    }

    .booking-info strong {
        color: #0064be; /* Đồng bộ với btn-primary */
        font-weight: 600;
        display: inline-block;
        width: 100px; /* Giữ chiều rộng cố định cho nhãn */
    }

    .price-value {
        color: #e74c3c; /* Giữ màu đỏ cho giá */
        font-weight: bold;
    }

    /* Form */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #495057; /* Đồng bộ với bảng */
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #eee; /* Đồng bộ với bảng */
        border-radius: 4px;
        font-size: 14px; /* Đồng bộ với bảng */
        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: #0064be; /* Đồng bộ với btn-primary */
        outline: none;
        box-shadow: 0 0 5px rgba(0, 100, 190, 0.3);
    }

    /* Nút */
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

    .btn-submit {
        background-color: #0064be; /* Đồng bộ với btn-primary */
        color: white;
        padding: 12px 20px;
        width: 100%;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-submit:hover {
        background-color: #004a8f; /* Tông đậm hơn khi hover */
    }

    .btn-back {
        background-color: #ff9800; /* Đồng bộ với btn-warning */
        color: white;
        margin-top: 10px;
    }

    .btn-back:hover {
        background-color: #e68900; /* Tông đậm hơn khi hover */
    }

    /* CSS cho trạng thái status */
    .status {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        display: inline-block;
    }

    .status-pending {
        background-color: #fff8e6; /* Vàng nhạt */
        color: #e6a700; /* Vàng đậm */
    }

    .status-confirmed {
        background-color: #e6f7ee; /* Xanh nhạt */
        color: #00b74a; /* Xanh lá */
    }

    .status-cancelled {
        background-color: #feeaec; /* Hồng nhạt */
        color: #f44336; /* Đỏ */
    }

    /* Responsive cho màn hình nhỏ */
    @media (max-width: 992px) {
        .booking-container {
            width: calc(100% - 40px);
            margin: 70px 20px 30px 20px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('editBookingForm');
        const statusSelect = document.getElementById('status');
        const currentStatus = statusSelect.value;
        let selectedStatus = currentStatus;

        function handleStatusChange(newStatus) {
            if (currentStatus === 'pending') {
                if (newStatus !== 'confirmed' && newStatus !== 'cancelled') {
                    alert('Từ trạng thái Chờ Xác Nhận, bạn chỉ có thể chuyển sang Đã Xác Nhận hoặc Đã Hủy');
                    statusSelect.value = selectedStatus;
                    return false;
                }
            } else if (currentStatus === 'confirmed') {
                if (newStatus !== 'cancelled') {
                    alert('Từ trạng thái Đã Xác Nhận, bạn chỉ có thể chuyển sang Đã Check In');
                    statusSelect.value = selectedStatus;
                    return false;
                }
            }
            else if (currentStatus === 'completed') {
                if (newStatus !== 'cancelled') {
                    alert('Từ trạng thái Đã Check In, bạn chỉ có thể chuyển sang Đã Hủy');
                    statusSelect.value = selectedStatus;
                    return false;
                }
            }  
            else if (currentStatus === 'cancelled') {
                alert('Không thể thay đổi trạng thái từ Đã Hủy');
                statusSelect.value = selectedStatus;
                return false;
            }
            
            selectedStatus = newStatus;
            return true;
        }

        statusSelect.addEventListener('change', function() {
            const newStatus = this.value;
            handleStatusChange(newStatus);
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            const bookingId = '{{ $booking['id'] }}';

            fetch(`/admin/bookings/update/${bookingId}`, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Cập nhật đặt phòng thành công!');
                    window.location.href = '/admin/bookings/edit/{{ $booking['id'] }}';
                } else {
                    alert('Lỗi cập nhật đặt phòng: ' + (data.message || 'Lỗi không xác định'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Đã xảy ra lỗi khi cập nhật đặt phòng.');
            });
        });
    });
</script>

<div class="booking-container">
    <h2 class="booking-title">Chỉnh sửa đặt phòng</h2>
    
    <div class="booking-info">
        @foreach($user as $users)
            @if($booking['user_id'] == $users['id'])
                <p><strong>Khách hàng:</strong> {{ $users['full_name'] }}</p>
            @endif
        @endforeach
        @foreach($room as $rooms)
            @if($booking['room_id'] == $rooms['id'])
                <p><strong>Phòng:</strong> {{ $rooms['name'] }}</p>
            @endif
        @endforeach
        <p><strong>Giá:</strong> <span class="price-value">{{ number_format($booking['total_price'], 0, ',', '.') }} VNĐ</span></p>
    </div>

    <form id="editBookingForm" method="POST" action="/admin/bookings/update/{{ $booking['id'] }}">
        @csrf
        <input type="hidden" name="_token" value="{{ $csrfToken }}">
        @method('POST')
        <input type="hidden" name="id" value="{{ $booking['id'] }}">
        
        <div class="form-group">
            <label for="status">Trạng thái:</label>
            <select id="status" name="status" class="form-control">
                <option value="pending" {{ $booking['status'] == 'pending' ? 'selected' : '' }}>Chờ Xác Nhận</option>
                <option value="confirmed" {{ $booking['status'] == 'confirmed' ? 'selected' : '' }}>Đã Xác Nhận</option>
                <option value="completed" {{ $booking['status'] == 'completed' ? 'selected' : '' }}>Đã Checkin</option>
                <option value="cancelled" {{ $booking['status'] == 'cancelled' ? 'selected' : '' }}>Đã Hủy</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-submit">Cập nhật đặt phòng</button>
        <a href="/admin/bookings/" class="btn btn-back">Trở lại</a>
    </form>
</div>
@endsection