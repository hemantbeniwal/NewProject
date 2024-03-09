<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>State Edit page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <h2>State Edit page</h2>
    {{-- {{$country}}
    {{die();}} --}}
    <form action="{{ route('state.update', $state->id) }}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>Country Name:</td>
                <td>

                    <select name="country_id">
                        @foreach ($country as $_country)
                            <option value="{{ $_country->id }}"
                                {{ ($state->country_id == $_country->id) ? 'selected' : '' }}>
                                {{ $_country->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="state" value="{{ $state->state }}"></td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>
                    {{-- ($_country["country_status"] == 1) ? "selected" : null --}}
                    <select name="status">
                        <option value="1" {{ $state->status == 1 ? 'selected' : null }}>Enable</option>
                        <option value="2" {{ $state->status == 2 ? 'selected' : null }}>Disable</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>City:</td>

                <table id="add">
                    <tr>
                        <th>City Name</th>
                        <th>City status</th>

                        <td><button type="button" id="addmore">+</button></td>

                    </tr>
                    <tr>
                        @foreach ($state->cities as $_city)
                        {{-- {{$_city}}
                            {{die();}} --}}
                            <input type="hidden"name="city_id[]" value="{{$_city->id}}">
                            <td>
                                <input type="text" name ="city_name[]" value="{{$_city->city_name}}"></td>
                            <td>
                                <select name ="city_status[]">
                                    <option value="">action</option>
                                    <option value="1" {{($_city->city_status == '1' )? 'selected' : null}}>Enable</option>
                                    <option value="2" {{($_city->city_status == '2' )? 'selected' : null}}>disable</option>
                                </select>
                            </td>
                            <td><button class ="remove" type = "button">X</button></td>
                    </tr>
                    @endforeach
                </table>

            </tr>
            <tr>
                <td>

                    <input type="reset" value="Reset">
                    <input type="submit" value="Save">
                </td>
            </tr>
        </table>
    </form>

</body>
<script>
    $(document).ready(function() {
        $("#addmore").click(function() {
            add_more = '<tr>\
           <td><input type="text" name ="city_name[]"></td>\
        <td>\
            <select name ="city_status[]">\
                <option value="">action</option>\
                <option value="1">Enable</option>\
                <option value="2">disable</option>\
            </select>\
        </td>\
        <td><button class ="remove" type = "button">X</button></td>\
    </tr>'
            $('#add').append(add_more);
        });

        $("#add").delegate(".remove", "click", function() {

            $(this).closest("tr").remove()
        });

    });
</script>

</html>
