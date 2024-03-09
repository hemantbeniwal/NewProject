<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>state List</title>
</head>
<body>
    <h3>State List</h3>
    <a href="{{route('state.create')}}">create</a>
    
    <table border="1" cellspacing="0">
        <tr>
            <th>Sr.No</th>
            <th>Country Name</th>
            <th>State Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @php
            $i =1;
        @endphp
        @foreach ($states as $_state)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$_state->country->name}}</td>
            <td>{{$_state->state}}</td>
            <td>{{$_state->status}}</td>
            <td>
                <a href="{{route('state.edit', $_state->id)}}">Edit</a>
                <form action="{{route('state.destroy', $_state->id)}}" method="POST">
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