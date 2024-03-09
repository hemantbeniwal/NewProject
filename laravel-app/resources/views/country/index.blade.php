<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Country page</title>
</head>
<body>
    <h2>Country Home page </h2>
    <a href="{{route('country.create')}}">create</a>
    <table border="1" cellspacing="0">
        <tr>
            <th>Sr.No</th>
            <th>Countay Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @php
            $i =1;
        @endphp
        @foreach ($country as $_country)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$_country->name}}</td>
            <td>{{$_country->status}}</td>
            <td>
                <a href="{{route('country.edit', $_country->id)}}">Edit</a>
                <form action="{{route('country.destroy', $_country->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" name="delete" value="delete">
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>