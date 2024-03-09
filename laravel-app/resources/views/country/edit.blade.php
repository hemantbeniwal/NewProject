<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <h2>Edit page</h2>
    <form action="{{ route('country.update', $country->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" value="{{ $country->name }}"></td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>
                    {{-- ($_country["country_status"] == 1) ? "selected" : null --}}
                    <select name="status">
                        <option value="1"{{ $country->status == '1' ? 'selected' : null }}>Enable</option>
                        <option value="2"{{ $country->status == '2' ? 'selected' : null }}>Disable</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>states:</td>
                <td>
                    <table id="add">
                        <tr>
                            <th>Name</th>
                            <th>status</th>
                    
                            <td><button type="button" id="addmore">+</button></td>
                        </tr>
                        @foreach ($country->states as $_states) 
                        <tr>
                            <input type="hidden"name="state_id[]"value="{{$_states->id}}">
                        
                            <td><input type="text" name ="state_name[]" value="{{ $_states->state}}"></td>
                            <td>
                                <select name ="state_status[]">
                                    <option value="">action</option>
                                    <option value="1" {{ ($_states->status == '1') ? 'selected' : null }}>Enable</option>
                                    <option value="2" {{ ($_states->status == '2') ? 'selected' : null }}>disable</option>
                                </select>
                            </td>
                            <td><button class ="remove" type = "button">X</button></td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Update">
                </td>
            </tr>
        </table>
    </form>

</body>
<script>

    $(document).ready(function () {
        $("#addmore").click(function () {
            add_more = '<tr>\
    <td><input type="text" name ="state_name[]"></td>\
        <td>\
            <select name ="state_status[]">\
                <option value="">action</option>\
                <option value="1">Enable</option>\
                <option value="2">disable</option>\
            </select>\
        </td>\
        <td><button class ="remove" type = "button">X</button></td>\
    </tr>'
            $('#add').append(add_more);
        });

        $("#add").delegate(".remove", "click", function () {

            $(this).closest("tr").remove()
        });

    });

</script>   

</html>
