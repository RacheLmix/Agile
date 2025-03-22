@extends('admin.layout')
@section('content')
    <style>
        .table-container {
            width: 90%; /* Chiều rộng của bảng */
            margin: 50px auto; /* Căn giữa và cách trên 50px */
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e0e0e0;
        }

    </style>

    <div class="table-container">
        <table>
            <tr>
                <th>Rooms ID</th>
                <th>HomeStay Name</th>
                <th>Rooms Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Capacity</th>
                <th>Bed</th>
                <th>Size</th>
                <th>Amenities</th>
                <th>Img</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @foreach($rooms as $room)
                <tr>
                    <td>{{ $room['id'] }}</td>
                    <td>{{ $room['name_homestay'] }}</td>
                    <td>{{ $room['name'] }}</td>
                    <td>{{ $room['description'] }}</td>
                    <td>{{ $room['price'] }}</td>
                    <td>{{ $room['quantity'] }}</td>
                    <td>{{ $room['capacity'] }}</td>
                    <td>{{ $room['beds'] }}</td>
                    <td>{{ $room['size'] }}</td>
                    <td>{{ $room['amenities'] }}</td>
                    <td><img width="100px" src="{{ file_url($room['image']) }}" alt="" srcset=""></td>
                    <td>{{ $room['status'] }}</td>
                    <td>
                        <a href="/admin/rooms/detail/{{$room['id']}}">Details</a>
                        <a href="/admin/bookings/edit/{{$room['id']}}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </table>
        <a href="/admin/rooms/create" >Add</a>
    </div>
@endsection
