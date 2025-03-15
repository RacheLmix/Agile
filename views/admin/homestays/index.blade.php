@extends('admin.layout')

@section('title', 'Homestay')

@section('content')
<style>
    .homestay-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px,1fr));
    }
    .container{
        margin: 70px 0 0 280px;
    }

    .homestay-item {
        background: #ffffff;
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .homestay-item img {
        width: 100%; /* Set image width to cover the card width */
        height: 200px; /* Fixed height for all images */
        object-fit: cover; /* Cover the frame without distorting the image */
        border-radius: 4px; /* Optional: round the corners of the image */
        margin-bottom: 15px; /* Space between image and text content */
    }

    .homestay-item h3 {
        color: #333;
        margin-bottom: 10px;
    }

    .homestay-item p {
        margin-bottom: 10px;
        color: #666;
        font-size: 14px;
    }

    .btn-primary {
        background-color: #4e73df;
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 4px;
        display: block;
        text-align: center;
        transition: background-color 0.3s;
        margin-top: 10px;
    }

    .btn-primary:hover {
        background-color: #4056a1;
    }
    .create{
        text-decoration: none;
        background:#4e73df;
        padding: 10px 15px;
        border-radius: 5px;
        color: #fff;
        margin-left: 10px;
        margin-bottom: 10px;
    }
    h1{
        text-align: center;
    }
</style>
<div class="homestay-container">
    <h1>List Homestay</h1>
    <a class="create" href="">Create Homestay</a>
    <div class="homestay-list">
        @foreach ($homestay as $home)
        <div class="homestay-item">
            <img src="{{ $home['image'] }}" alt="Image of {{ $home['name'] }}">
            <h3>{{ $home['name'] }}</h3>
            <p><strong>Location:</strong> {{ $home['location'] }}</p>
            <p><strong>Description:</strong> {{ $home['description'] }}</p>
            <p><strong>Rating:</strong> {{ $home['rating'] }} / 5.0</p>
            <a href="/admin/homestay/detail/{{ $home['homestay_id'] }}" class="btn btn-primary">View Details</a>
            <a href="/admin/homestay/detail/{{ $home['homestay_id'] }}" class="btn btn-primary">Update</a>
            <a href="/admin/homestay/detail/{{ $home['homestay_id'] }}" class="btn btn-primary">Delete</a>
        </div>
        @endforeach
    </div>
</div>
@endsection