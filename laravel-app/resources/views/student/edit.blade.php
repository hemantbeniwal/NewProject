<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page Edit </title>
    <style>
        form {
            background: rgb(75, 191, 167)
        }
    </style>
</head>

<body>
    <h2>Edit Student</h2>
    <form action="{{route('student.update',$student->id)}}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>First name:</td>
                <td><input type="name" name="first_name" value="{{$student->first_name}}">(Max 30 characters a-z and A-Z) </td>
            </tr>
            <tr>
                <td>Last name:</td>
                <td><input type="name" name="last_name" value="{{$student->last_name}}">(Max 30 characters a-z and A-Z) </td>
            </tr>
            <tr>
                <td>Date of birth:</td>
                <td>
                    <input type="date" name="dob" value="{{$student->dob}}">
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" value="{{$student->email}}"></td>
            </tr>
            <tr>
                <td>Mobile Number:</td>
                <td><input type="tel" name="phone" value="{{$student->phone}}"></td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td>
                    <input type="radio" name="gender" value="m"{{ (($student->gender ?? NULL) == "M") ? "checked" : "" }}>Male
                    <input type="radio" name="gender" value="f"{{(($student->gender ?? NULL) == "f") ? "checked" : ""}}>Femele
                </td>
            </tr>
            <tr>
                <td>Address:</td>
                <td>
                    <textarea name="address" cols="20" rows="5" >{{$student->address}}"</textarea>
                </td>
            </tr>
            <tr>
                <td>City:</td>
                <td><input type="name" name="city" value="{{$student->city}}"></td>
            </tr>
            <tr>
                <td>Pin code:</td>
                <td><input type="number" name="pin_code" value="{{$student->pin_code}}"></td>
            </tr>
            <tr>
                <td>State:</td>
                <td><input type="name" name="state" value="{{$student->state}}"></td>
            </tr>
            <tr>
                <td>Country:</td>
                <td><input type="name" name="country" value="{{$student->country}}"></td>
            </tr>
            @php
                    $student_hobbies = explode(",", $student->hobbies);
                    // dd($student_hobbies);
        
            @endphp
            <tr>
                <td>Hobbies</td>
                <td><input type="checkbox" name="hobbies[]" value="drowing"{{(in_array("drowing", ($student_hobbies ?? []))) ? "checked" : ""  }}>Drowing
                    <input type="checkbox" name="hobbies[]" value="dancing" {{(in_array("dancing", ($student_hobbies ?? []))) ? "checked" : "" }}>Dancing
                    <input type="checkbox" name="hobbies[]" value="singing" {{(in_array("singing", ($student_hobbies ?? []))) ? "checked" : "" }}>Singing
                    <input type="checkbox" name="hobbies[]" value="sketching" {{(in_array("sketching", ($student_hobbies ?? []))) ? "checked" : "" }}>Sketching<br>
                    <input type="checkbox" name="hobbies[]" value="other" {{(in_array("other", ($student_hobbies ?? []))) ? "checked" : ""}}>other
                    

                </td>
            </tr>

            <tr>
                <td>Qualification:</td>
                <td>
                    <table>

                        <tr>
                            {{-- <th></th> --}}
                            {{-- <th></th> --}}
                            {{-- <th>Sl.No</th> --}}
                            <th>Examination</th>
                            <th>Board</th>
                            <th>Percentage</th>
                            <th>Year of Passing</th>
                        </tr>
                        {{-- {{$i =1;}} --}}
                        @foreach ($student->stQulifications as $_quali)
                            {{-- {{dd($_quali);}} --}}
                        <tr>
                            <input type="hidden"name="stuId[]"value="{{$_quali->id}}">
                            <td><input type="text"name="examination[]" value="{{$_quali->examination}}" readonly></td>
                            <td><input type="text"name="board[]" value="{{$_quali->board}}"></td>
                            <td><input type="number"name="percentage[]" value="{{$_quali->percentage}}"></td>
                            <td><input type="text"name="year_of_passing[]" value="{{$_quali->year_of_passing}}"></td>
                        </tr>
                        @endforeach
                        
                    </table>
                </td>

            </tr>
            <tr>
                <td>courses Applied For :</td>
                <td>
                    <input type="checkbox" name="courses" value="bca"{{($student->courses=='bca')? 'checked':''}}>Bca
                    <input type="checkbox" name="courses" value="bcom"{{($student->courses=='bcom')? 'checked':''}}>B.com
                    <input type="checkbox" name="courses" value="bsc"{{($student->courses=='bsc')? 'checked':''}}>B.Sc
                    <input type="checkbox" name="courses" value="ba"{{($student->courses=='ba')? 'checked':''}}>B.A
                    
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Update">
                </td>
            </tr>


        </table>

    </form>

</body>

</html>
