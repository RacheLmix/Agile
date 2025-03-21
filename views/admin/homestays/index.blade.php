@extends('admin.layout')

@section('title', 'Homestay')

@section('style')
<style>
    .homestay-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px,1fr));
    }
</style>
@endsection

@section('content')
<style>
    .homestay-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px,1fr));
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
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
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
    <a class="create" href="/admin/homestays/create">Create Homestay</a>
    <div class="homestay-list">
        @foreach ($homestays as $homestay)
            <div class="homestay-item">
                <img src="{{file_url($homestay['image'])}}" alt="Image of {{ $homestay['name'] }}">
                <h3>{{ $homestay['name'] }}</h3>
                <p><strong>Location:</strong> {{ $homestay['location'] }}</p>
                <p><strong>Address:</strong> {{ $homestay['address'] }}</p>
                <p style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><strong>Description:</strong> {{ $homestay['description'] }}</p>
                <p><strong>Rating:</strong> {{ $homestay['rating'] }} / 5.0</p>
                <p><strong>Category:</strong> {{ $homestay['category_name'] }} </p>
                <a href="/admin/homestays/detail/{{ $homestay['id'] }}" class="btn btn-primary">View Details</a>
                <a href="/admin/homestays/edit/{{ $homestay['id'] }}" class="btn btn-primary">Update</a>
                <a onclick="return confirm('Bạn có chắc muốn xóa homestay không?')" href="/admin/homestays/delete/{{ $homestay['id'] }}" class="btn btn-primary">Delete</a>
            </div>
        @endforeach
    </div>
</div>
@endsection