<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<table>
    <tr>
        @foreach($booking as $book)
        <td>{{$book['booking_id']}}</td>
        @endforeach
    </tr>
</table>
</body>
</html>