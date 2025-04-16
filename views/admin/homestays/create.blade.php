@extends('admin.layout')

@section('title', 'Create Homestay')

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
    <h1>Create New Homestay</h1>
    
    <form class="create-form" action="/admin/homestays/store" method="POST" enctype="multipart/form-data">   
        <div class="form-group">
            <label for="name">Homestay Name</label>
            <input type="text" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" id="location" name="location">
        </div>

        <div class="form-group">
            <label for="price">Price (VND)</label>
            <input type="number" id="price" name="price" min="0" step="1000" placeholder="Enter price per night">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description"></textarea>
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
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