<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đặt phòng</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <!-- Header -->
        <h1 class="text-3xl font-bold mb-6">Chi tiết đặt phòng #{{ $booking['id'] ?? 'N/A' }}</h1>

        @if (isset($error))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                {{ $error }}
            </div>
        @else
            <!-- Booking Details -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-semibold mb-4">Thông tin đặt phòng</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p><strong>Mã đặt phòng:</strong> {{ $booking['id'] }}</p>
                        <p><strong>Ngày nhận phòng:</strong> {{ date('d/m/Y', strtotime($booking['check_in'])) }}</p>
                        <p><strong>Ngày trả phòng:</strong> {{ date('d/m/Y', strtotime($booking['check_out'])) }}</p>
                        <p><strong>Số đêm:</strong> {{ $booking['nights'] }}</p>
                        <p><strong>Số khách:</strong> {{ $booking['guests'] }}</p>
                    </div>
                    <div>
                        <p><strong>Tổng giá:</strong> {{ number_format($booking['total_price'], 0, ',', '.') }} VNĐ</p>
                        <p><strong>Trạng thái:</strong> 
                            @if ($booking['status'] == 'pending')
                                <span class="text-yellow-600">Chờ xác nhận</span>
                            @elseif ($booking['status'] == 'confirmed')
                                <span class="text-green-600">Đã xác nhận</span>
                            @elseif ($booking['status'] == 'cancelled')
                                <span class="text-red-600">Đã hủy</span>
                            @else
                                <span>{{ $booking['status'] }}</span>
                            @endif
                        </p>
                        <p><strong>Ngày đặt:</strong> {{ date('d/m/Y H:i', strtotime($booking['created_at'])) }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4">
                    @if ($booking['status'] == 'pending')
                        <a href="/bookings/checkin/{{ $booking['id'] }}" 
                           class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mr-2">
                            Check-in
                        </a>
                        <a href="/bookings/cancel/{{ $booking['id'] }}" 
                           class="inline-block bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                           onclick="return confirm('Bạn có chắc muốn hủy đặt phòng này?')">
                            Hủy đặt phòng
                        </a>
                    @else
                        <button disabled class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed mr-2">
                            Check-in
                        </button>
                        <button disabled class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed">
                            Hủy đặt phòng
                        </button>
                    @endif
                    <a href="/orderview" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 ml-2">
                        Quay lại danh sách
                    </a>
                </div>
            </div>

            <!-- Homestay Details -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h2 class="text-2xl font-semibold mb-4">Thông tin homestay</h2>
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/3">
                        @if ($homestay['image'])
                            <img src="{{ $homestay['image'] }}" alt="{{ $homestay['name'] }}" 
                                 class="w-full h-48 object-cover rounded-lg">
                        @else
                            <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                Không có hình ảnh
                            </div>
                        @endif
                    </div>
                    <div class="md:w-2/3 md:pl-6 mt-4 md:mt-0">
                        <h3 class="text-xl font-medium">{{ $homestay['name'] ?? 'Unknown Homestay' }}</h3>
                        <p><strong>Phòng:</strong> {{ $room['name'] ?? 'Unknown Room' }}</p>
                        <p><strong>Địa điểm:</strong> {{ $homestay['location'] ?? 'N/A' }}, {{ $homestay['city'] ?? 'N/A' }}</p>
                        <p><strong>Giá mỗi đêm:</strong> {{ number_format($homestay['price'] ?? 0, 0, ',', '.') }} VNĐ</p>
                        <p><strong>Đánh giá:</strong> {{ $homestay['rating'] ?? 'Chưa có' }}/5</p>
                        @if (isset($amenities) && is_array($amenities) && count($amenities) > 0)
                            <p><strong>Tiện ích:</strong> 
                                {{ implode(', ', array_column($amenities, 'name')) }}
                            </p>
                        @else
                            <p><strong>Tiện ích:</strong> Không có</p>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>
</html>