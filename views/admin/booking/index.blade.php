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
                <th>Booking ID</th>
                <th>User Name</th>
                <th>Rooms Name</th>
                <th>Check in</th>
                <th>Check out</th>
                <th>guests</th>
                <th>total_price</th>
                <th>guests</th>
                <th>Action</th>
            </tr>
            @foreach($booking as $book)
                <tr>
                    <td>{{ $book['id'] }}</td>
                    <td>{{ $book['user_name'] }}</td>
                    <td>{{ $book['room_name'] }}</td>
                    <td>{{ $book['check_in'] }}</td>
                    <td>{{ $book['check_out'] }}</td>
                    <td>{{ $book['guests'] }}</td>
                    <td>{{ $book['total_price'] }}</td>
                    <td>{{ $book['status'] }}</td>
                    <td>
                        <a href="/admin/booking/details/{{$book['id']}}">Details</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
