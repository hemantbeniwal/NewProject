<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student List</title>
</head>
<body>
    <h2>Student List</h2>
    <a href="{{route('student.create')}}">create</a>
    <table border="1" cellspacing="0">
        <tr>
            <td>Sr.no</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Date Of Birth</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Gender</td>
            <td>Address</td>
            <td>City</td>
            <td>Pincode</td>
            <td>state</td>
            <td>Country</td>
            <td>Hobbies</td>
            <td>Qualification</td>
            <td>Courses</td>
            <td>Action</td>
        </tr>
        @php
            $i =1;
        @endphp
        @foreach($students as $_student )
            
        <tr>
            <td>{{$i++}}</td>
            <td>{{$_student->first_name}}</td>
            <td>{{$_student->last_name}}</td>
            <td>{{$_student->dob}}</td>
            <td>{{$_student->email}}</td>
            <td>{{$_student->phone}}</td>
            <td>{{$_student->gender}}</td>
            <td>{{$_student->address}}</td>
            <td>{{$_student->city}}</td>
            <td>{{$_student->pin_code}}</td>
            <td>{{$_student->state}}</td>
            <td>{{$_student->country}}</td>
            <td>{{$_student->hobbies}}</td>
            <td>{{$_student->courses}}</td>
            <td>
                <a href="{{route('student.edit',$_student->id)}}">Edit</a>
                <form action="{{route('student.destroy',$_student->id)}}" method="POST"></a>
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