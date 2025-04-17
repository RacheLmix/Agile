@extends('admin.layout')

@section('title', 'Homestay Detail')

@section('content')
<style>
    .detail-container {
        margin: 50px 0;
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

    .amenities-section {
        margin-top: 40px;
    }

    .amenities-section h2 {
        color: #333;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .amenities-list {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .amenity-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .amenity-item i {
        color: #4e73df;
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
    <a href="/admin/homestays" class="back-link">← Back to Homestays</a>

    <div class="detail-header">
        <h1>Homestay Details</h1>
        <div class="action-buttons">
            <a href="/admin/homestays/edit/{{ $homestays['id'] }}" class="btn btn-warning">Edit</a>
            <form action="/admin/homestays/delete/{{ $homestays['id'] }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this homestay?');">
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
                <div class="rating-value">{{ $homestays['rating'] }} / 5.0 ({{ $homestays['review_count'] ?? 0 }} reviews)</div>
            </div>
            
            <div class="info-section">
                <div class="info-label">Price</div>
                <div class="info-value">{{ number_format($homestays['price'], 0, ',', '.') }} VND per night</div>
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
                <div class="info-label">City</div>
                <div class="info-value">{{ $homestays['city'] }}</div>
            </div>

            <div class="info-section">
                <div class="info-label">Country</div>
                <div class="info-value">{{ $homestays['country'] }}</div>
            </div>
            
            <div class="info-section">
                <div class="info-label">Category</div>
                <div class="info-value">{{ $homestays['category_name'] ?? 'N/A' }}</div>
            </div>
            
            <div class="info-section">
                <div class="info-label">Description</div>
                <div class="info-value description">{{ $homestays['description'] }}</div>
            </div>

            <div class="info-section">
                <div class="info-label">Status</div>
                <div class="info-value">{{ ucfirst($homestays['status']) }}</div>
            </div>
            
            <div class="meta-info">
                <div>Created: {{ date('d/m/Y H:i', strtotime($homestays['created_at'])) }}</div>
                <div>Updated: {{ date('d/m/Y H:i', strtotime($homestays['updated_at'])) }}</div>
            </div>
        </div>
    </div>

    <!-- Amenities Section -->
    <div class="amenities-section">
        <h2>Amenities</h2>
        @if (!empty($amenities))
            <div class="amenities-list">
                @foreach ($amenities as $amenity)
                    <div class="amenity-item">
                        <i class="{{ $amenity['icon'] }}"></i>
                        <span>{{ $amenity['name'] }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <p>No amenities available.</p>
        @endif
    </div>
</div>
@endsection