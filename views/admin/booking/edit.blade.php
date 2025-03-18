@extends('admin.layout')
@section('content')
<style>
    .booking-container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        padding: 25px;
        font-family: Arial, sans-serif;
    }
    
    .booking-title {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-size: 24px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }
    
    .booking-info {
        background-color: #f9f9f9;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    
    .booking-info p {
        margin: 10px 0;
        font-size: 16px;
        line-height: 1.5;
    }
    
    .booking-info strong {
        color: #555;
        display: inline-block;
        width: 100px;
    }
    
    .price-value {
        color: #e74c3c;
        font-weight: bold;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #555;
    }
    
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        box-sizing: border-box;
    }
    
    .form-control:focus {
        border-color: #4a90e2;
        outline: none;
    }
    
    .btn-submit {
        background-color: #4a90e2;
        color: white;
        border: none;
        padding: 12px 20px;
        width: 100%;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    .btn-submit:hover {
        background-color: #357ab8;
    }
    
    .status-pending {
        background-color: #fff8e1;
    }
    
    .status-confirmed {
        background-color: #e8f5e9;
    }
    
    .status-cancelled {
        background-color: #ffebee;
    }
    
    select option[value="pending"] {
        background-color: #fff8e1;
    }
    
    select option[value="confirmed"] {
        background-color: #e8f5e9;
    }
    
    select option[value="cancelled"] {
        background-color: #ffebee;
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
                    alert('Từ trạng thái Đã Xác Nhận, bạn chỉ có thể chuyển sang Đã Hủy');
                    statusSelect.value = selectedStatus;
                    return false;
                }
            } else if (currentStatus === 'cancelled') {
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
    <h2 class="booking-title">Chi tiết đặt phòng</h2>
    
    <div class="booking-info">
        @foreach($user as $users)
            @if($booking['user_id'] == $users['id'])
                <p><strong>Khách hàng:</strong> {{$users['full_name']}}</p>
            @endif
        @endforeach
        @foreach($room as $rooms)
            @if($booking['room_id'] == $rooms['id'])
                <p><strong>Phòng:</strong> {{$rooms['name']}}</p>
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
                <option value="cancelled" {{ $booking['status'] == 'cancelled' ? 'selected' : '' }}>Đã Hủy</option>
            </select>
        </div>
        
        <button type="submit" class="btn-submit">Cập nhật đặt phòng</button>
        <a href="/admin/bookings/" class="btn-back">Trở lại</a>
    </form>
</div>
@endsection
