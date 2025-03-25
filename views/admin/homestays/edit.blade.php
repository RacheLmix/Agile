@extends('admin.layout')

@section('title', 'Edit Homestay')

@section('content')
<style>
    .create-container {
        margin: 70px 0 0 280px;
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
</style>

<div class="create-container">
    <a href="/admin/homestays" class="back-link">← Back to List</a>
    <h1>Edit Homestay</h1>
    
    <form class="create-form" action="/admin/homestays/update/{{ $homestays['id'] }}" method="POST" enctype="multipart/form-data">   
        <div class="form-group">
            <label for="name">Homestay Name</label>
            <input type="text" id="name" name="name" value="{{ $homestays['name'] }}">
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" value="{{ $homestays['location'] }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input id="description" name="description" value="{{ $homestays['description'] }}">
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input id="location" name="location" value="{{ $homestays['location'] }}">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input id="address" name="address" value="{{ $homestays['address'] }}">
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}" {{ $homestays['category_id'] == $category['id'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <div class="form-group">
            <button type="submit" class="btn-submit">Create Homestay</button>
        </div>
    </form>
</div>
@endsection