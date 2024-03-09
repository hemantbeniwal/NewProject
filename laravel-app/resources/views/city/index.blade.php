<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>City Index page</title>
</head>
<body>
    <h2>City Index page</h2>
    <a href="{{route('city.create')}}">create</a>
    
    <table border="1" cellspacing="0">
        <tr>
            <th>Sr.No</th>
            <th>Country Id</th>
            <th>State Id</th>
            <th>City Name</th>
            <th>City Status</th>
            <th>Action</th>
        </tr>
    
        @php
            $i =1;
        @endphp
        @foreach ($city as $_city)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$_city->country->name}}</td>
            <td>{{$_city->statess->state}}</td>
        
            <td>{{$_city->city_name}}</td>
            <td>{{$_city->city_status}}</td>
            <td>
                <a href="{{route('city.edit', $_city->id)}}">Edit</a>
                <form action="{{route('city.destroy', $_city->id)}}" method="POST">
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