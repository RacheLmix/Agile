@extends('admin.layout')

@section('title', 'Homestay Detail')

@section('content')
<style>
    .detail-container {
        margin: 70px 0 0 280px;
        padding: 20px;
    }

    .back-link {
        display: inline-block;
        margin-bottom: 20px;
        color: #4e73df;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 8px 15px;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 500;
        display: inline-block;
    }

    .btn-primary {
        background-color: #4e73df;
        color: white;
    }

    .btn-warning {
        background-color: #f6c23e;
        color: #212529;
    }

    .btn-danger {
        background-color: #e74a3b;
        color: white;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .homestay-detail {
        display: flex;
        gap: 30px;
        margin-bottom: 40px;
    }

    .homestay-image {
        flex: 0 0 50%;
        overflow: hidden;
        /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
    }
    
    .homestay-image img {
        width: 100%;
        height: 400px;
        border-radius: 8px;
        object-fit: cover;
    }

    .homestay-info {
        flex: 1;
    }

    .homestay-info h1 {
        color: #333;
        margin-top: 0;
        margin-bottom: 20px;
        font-size: 28px;
    }

    .info-section {
        margin-bottom: 15px;
    }

    .info-label {
        font-weight: bold;
        color: #555;
        margin-bottom: 5px;
    }

    .info-value {
        color: #333;
    }

    .description {
        line-height: 1.6;
    }

    .rating {
        display: flex;
        align-items: center;
        margin: 15px 0;
    }

    .rating-stars {
        color: #f6c23e;
        margin-right: 10px;
        font-size: 20px;
    }

    .rating-value {
        font-weight: bold;
        font-size: 18px;
    }

    .rooms-section {
        margin-top: 40px;
    }

    .rooms-section h2 {
        color: #333;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .rooms-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .room-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .room-image {
        height: 180px;
        overflow: hidden;
    }

    .room-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .room-info {
        padding: 15px;
    }

    .room-info h3 {
        margin-top: 0;
        margin-bottom: 10px;
        color: #333;
        font-size: 18px;
    }

    .room-price {
        color: #4e73df;
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 18px;
    }

    .room-details {
        margin-bottom: 10px;
        color: #666;
    }

    .meta-info {
        display: flex;
        justify-content: space-between;
        color: #777;
        font-size: 14px;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #eee;
    }
</style>

<div class="detail-container">
    <a href="/admin/homestayss" class="back-link">← Back to Homestays</a>

    <div class="detail-header">
        <h1>Homestay Details</h1>
        <div class="action-buttons">
            <a href="/admin/homestays/edit/{{ $homestay['id'] }}" class="btn btn-warning">Edit</a>
            <form action="/admin/homestays/delete/{{ $homestay['id'] }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this homestay?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <div class="homestay-detail">
        <div class="homestay-image">
            <img src="{{ file_url($homestays['image']) }}" alt="{{ $homestays['name'] }}">
        </div>
        <div class="homestay-info">
            <h1>{{ $homestays['name'] }}</h1>
            
            <div class="rating">
                <div class="rating-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($homestays['rating']))
                            ★
                        @elseif ($i - 0.5 <= $homestays['rating'])
                            ☆
                        @else
                            ☆
                        @endif
                    @endfor
                </div>
                <div class="rating-value">{{ $homestays['rating'] }} / 5.0</div>
            </div>
            
            <div class="info-section">
                <div class="info-label">Location</div>
                <div class="info-value">{{ $homestays['location'] }}</div>
            </div>

            <div class="info-section">
                <div class="info-label">Address</div>
                <div class="info-value">{{ $homestays['address'] }}</div>
            </div>
            
            <div class="info-section">
                <div class="info-label">Category</div>
                <div class="info-value">
                 @foreach ($categories as $category)
                    @if ($homestays['category_id'] == $category['id'])
                        <p>{{ $category['name'] }}</p>
                    @endif
                @endforeach
                </div>
            </div>
            
            <div class="info-section">
                <div class="info-label">Description</div>
                <div class="info-value description">{{ $homestays['description'] }}</div>
            </div>
            
            <div class="meta-info">
                <div>Host: {{ $homestays['host_name'] ?? 'Unknown' }}</div>
                <div>Created: {{ $homestays['created_at'] }}</div>
            </div>
        </div>
    </div>
    
    <div class="rooms-section">
        <h2>Available Rooms</h2>
        
        <div class="rooms-list">
            @forelse ($rooms as $room)
                <div class="room-card">
                    <div class="room-image">
                        <img src="{{ $room['image'] ?? '/images/default-room.jpg' }}" alt="{{ $room['name'] }}">
                    </div>
                    <div class="room-info">
                        <h3>{{ $room['name'] }}</h3>
                        <div class="room-price">${{ $room['price'] }} / night</div>
                        <div class="room-details">
                            <div><strong>Capacity:</strong> {{ $room['capacity'] }} guests</div>
                            <div><strong>Amenities:</strong> {{ $room['amenities'] }}</div>
                        </div>
                        <a href="/admin/room/{{ $room['id'] }}" class="btn btn-primary">View Room</a>
                    </div>
                </div>
            @empty
                <p>No rooms available for this homestay.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
