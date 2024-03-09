<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student page </title>
    <style>
        form {
            background: rgb(75, 191, 167)
        }

        .error {
            color: darkred;
        }
    </style>
</head>

<body>
    <h2>Create Student</h2>
    <form action="{{ route('student.store') }}" method="POST">
        @csrf
        <table>
            <tr>
                <td>First name:</td>
                <td><input type="name" name="first_name" value="{{ old('first_name') }}">
                    @error('first_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Last name:</td>
                <td><input type="name" name="last_name" value="{{ old('last_name') }}">
                    @error('last_name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Date of birth:</td>
                <td>
                    <input type="date" name="dob" value="{{ old('dob') }}">
                    @error('dob')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" value="{{ old('email') }}">
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Mobile Number:</td>
                <td><input type="tel" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Gender:</td>
                <td>
                    <input type="radio" name="gender" value="M"{{ (old('gender') == 'M') ? 'checked' : null }}>Male
                    <input type="radio" name="gender"value="f" {{ (old('gender') == 'f' )? 'checked' : null }}>Femele
                    @error('gender')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Address:</td>
                <td>
                    <textarea name="address" cols="20" rows="5" >{{ old('address') }}
                    </textarea>
                    @error('address')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>City:</td>
                <td><input type="name" name="city" value="{{ old('city') }}">
                    @error('city')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Pin code:</td>
                <td><input type="number" name="pin_code" value="{{ old('pin_code') }}">
                    @error('pin_code')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>State:</td>
                <td><input type="name" name="state" value="{{ old('state') }}">
                    @error('state')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Country:</td>
                <td><input type="name" name="country" value="{{ old('country') }}">
                    @error('country')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Hobbies</td>

                @php
                    $hobbies = old('hobbies')??[]
                @endphp
                <td><input type="checkbox" name="hobbies[]"
                        value="drowing"{{ in_array('drowing',old('hobbies')??[]) ? 'checked' : null }}>Drowing
                    <input type="checkbox" name="hobbies[]"
                        value="singing"{{ in_array('singing',$hobbies) ? 'checked' : null }}>Singing
                    <input type="checkbox" name="hobbies[]"
                        value="dancing"{{ in_array('dancing',$hobbies) ? 'checked' : null }}>Dancing
                    <input type="checkbox" name="hobbies[]"
                        value="sketching"{{ in_array('sketching',$hobbies) ? 'checked' : null }}>Sketching<br>
                    <input type="checkbox" name="hobbies[]"
                        value="other"{{ in_array('other',$hobbies) ? 'checked' : null }}>other

                    @error('hobbies')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>Qualification:</td>
                <td>
                    <table >
                        <tr>
                            <th></th>
                            <th>Sl.No</th>
                            <th>Examination</th>
                            <th>Board</th>
                            <th>Percentage</th>
                            <th>Year of Passing</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1</td>
                            <td><input type="text"name="examination[]" value="class-X" readonly></td>
                            <td><input type="text"name="board[]"></td>
                            <td><input type="number"name="percentage[]"></td>
                            <td><input type="text"name="year_of_passing[]"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>2</td>
                            <td><input type="text" name="examination[]" value="Class-XII" readonly></td>
                            <td><input type="text" name="board[]"></td>
                            <td><input type="number" name="percentage[]"></td>
                            <td><input type="text" name="year_of_passing[]"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>3</td>
                            <td><input type="text"name="examination[]" value="graduation" readonly></td>
                            <td><input type="text" name="board[]"></td>
                            <td><input type="number" name="percentage[]"></td>
                            <td><input type="text" name="year_of_passing[]"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>4</td>
                            <td> <input type="text" name="examination[]" value="Masters" readonly></td>
                            <td><input type="text" name="board[]"></td>
                            <td><input type="number" name="percentage[]"></td>
                            <td><input type="text" name="year_of_passing[]"></td>
                        </tr>
                    </table>
                </td>

            </tr>
            <tr>
                <td>courses Applied For :</td>
                <td>
                    <input type="checkbox" name="courses"value="bca"
                        {{ old('courses') == 'bca' ? 'checked' : null }}>Bca
                    <input type="checkbox" name="courses" value="bcom"
                        {{ old('courses') == 'bcom' ? 'checked' : null }}>B.com
                    <input type="checkbox" name="courses" value="bsc"
                        {{ old('courses') == 'bsc' ? 'checked' : null }}>B.Sc
                    <input type="checkbox" name="courses" value="ba"
                        {{ old('courses') == 'ba' ? 'checked' : null }}>B.A

                    @error('courses')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit">
                    <input type="reset" name="reset">
                </td>
            </tr>


        </table>

    </form>

</body>

</html>
