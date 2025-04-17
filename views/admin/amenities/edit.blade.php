@extends('admin.layout')

@section('title', 'Edit Amenity')

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
    .form-group textarea {
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

    /* 🔥 THÊM CSS CHO THÔNG BÁO SESSION */
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
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-left: 5px solid #28a745;
    }
    .alert .close {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        color: inherit;
    }
</style>

<div class="create-container">
    <a href="/admin/amenities" class="back-link">← Back to List</a>
    <h1>Edit Amenity</h1>

    @if(isset($_SESSION['error']))
        <div class="alert alert-error">
            <span>{{ $_SESSION['error'] }}</span>
            <button type="button" class="close" onclick="this.parentElement.style.display='none'">×</button>
        </div>
        @php unset($_SESSION['error']); @endphp
    @endif

    <form class="create-form" action="/admin/amenities/update/{{ $amenity['id'] }}" method="POST">
        <div class="form-group">
            <label for="name">Amenity Name</label>
            <input type="text" id="name" name="name" value="{{ $_SESSION['old']['name'] ?? $amenity['name'] }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ $_SESSION['old']['description'] ?? $amenity['description'] }}</textarea>
        </div>

        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="text" id="icon" name="icon" value="{{ $_SESSION['old']['icon'] ?? $amenity['icon'] }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn-submit">Update Amenity</button>
        </div>
    </form>
    <?php unset($_SESSION['old']); ?>
</div>
@endsection