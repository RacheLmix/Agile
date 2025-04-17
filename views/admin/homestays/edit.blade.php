@extends('admin.layout')

@section('title', 'Edit Homestay')

@section('content')
<style>
    .create-container {
        margin: 50px 0;
        padding: 20px;
    }

    .create-form {
        background: #ffffff;
        border: 1px solid #ddd;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .form-group textarea {
        height: 150px;
        resize: vertical;
    }

    .amenities-group {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .amenity-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-submit {
        background-color: #4e73df;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .btn-submit:hover {
        background-color: #4056a1;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
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

    .alert {
        padding: 12px;
        border-radius: 5px;
        font-size: 14px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 5px solid #dc3545;
    }
</style>

<div class="create-container">
    <a href="/admin/homestays" class="back-link">← Back to List</a>
    <h1>Edit Homestay</h1>

    @if (isset($_SESSION['error']))
        <div class="alert alert-error">
            <span>{{ $_SESSION['error'] }}</span>
            <button type="button" class="close" onclick="this.parentElement.style.display='none'">×</button>
            <?php unset($_SESSION['error']); ?>
        </div>
    @endif

    <form class="create-form" action="/admin/homestays/update/{{ $homestays['id'] }}" method="POST" enctype="multipart/form-data">   
        <div class="form-group">
            <label for="name">Homestay Name</label>
            <input type="text" id="name" name="name" value="{{ $_SESSION['old']['name'] ?? $homestays['name'] }}">
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" value="{{ $_SESSION['old']['location'] ?? $homestays['location'] }}">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="{{ $_SESSION['old']['address'] ?? $homestays['address'] }}">
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" id="city" name="city" value="{{ $_SESSION['old']['city'] ?? $homestays['city'] }}">
        </div>

        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" id="country" name="country" value="{{ $_SESSION['old']['country'] ?? $homestays['country'] }}">
        </div>

        <div class="form-group">
            <label for="price">Price (VND)</label>
            <input type="number" id="price" name="price" value="{{ $_SESSION['old']['price'] ?? $homestays['price'] }}" min="0" step="1000" placeholder="Enter price per night">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ $_SESSION['old']['description'] ?? $homestays['description'] }}</textarea>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}" {{ (isset($_SESSION['old']['category_id']) ? $_SESSION['old']['category_id'] : $homestays['category_id']) == $category['id'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="active" {{ (isset($_SESSION['old']['status']) ? $_SESSION['old']['status'] : $homestays['status']) == 'active' ? 'selected' : '' }}>Hoạt động</option>
                <option value="inactive" {{ (isset($_SESSION['old']['status']) ? $_SESSION['old']['status'] : $homestays['status']) == 'inactive' ? 'selected' : '' }}>Đang xét duyệt</option>
                <option value="pending" {{ (isset($_SESSION['old']['status']) ? $_SESSION['old']['status'] : $homestays['status']) == 'pending' ? 'selected' : '' }}>Đang bảo trì</option>
                <option value="blocked" {{ (isset($_SESSION['old']['status']) ? $_SESSION['old']['status'] : $homestays['status']) == 'blocked' ? 'selected' : '' }}>Đã bị chặn</option>
            </select>
        </div>

        <div class="form-group">
            <label>Amenities</label>
            <div class="amenities-group">
                @foreach ($amenities as $amenity)
                    <div class="amenity-item">
                        <input type="checkbox" name="amenities[]" value="{{ $amenity['id'] }}"
                            {{ (isset($_SESSION['old']['amenities']) && in_array($amenity['id'], $_SESSION['old']['amenities'])) || 
                               (!isset($_SESSION['old']['amenities']) && in_array($amenity['id'], array_column($selectedAmenities, 'id'))) ? 'checked' : '' }}>
                        <label>{{ $amenity['name'] }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <div class="form-group">
            <button type="submit" class="btn-submit">Update Homestay</button>
        </div>
    </form>
    <?php unset($_SESSION['old']); ?>
</div>
@endsection