<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>state create</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <h2>State Create</h2>
    <form action="{{ route('state.store') }}" method="POST">
        @csrf
        <table>

            <tr>
                <td>Country Name:</td>
                <td>
                    <select name="country_id">
                        <option>select county </option>
                        @foreach ($countrydata as $_countrydata)
                            <option value="{{ $_countrydata->id }}">
                                {{ $_countrydata->name }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>State Name:</td>
                <td>
                    <input type="text" name="state" value="state">
                </td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>
                    <select name="status">
                        <option value="1">Enable</option>
                        <option value="2">Disable</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>City:</td>
                <td>
                    <table id="add">
                        <tr>
                            <th>City Name</th>
                            <th>City status</th>
                        
                            <td><button type="button" id="addmore">+</button></td>
                        </tr>
                            <td><input type="text" name ="city_name[]"></td>
                        <td>
                            <select name ="city_status[]">
                                <option value="">action</option>
                                <option value="1">Enable</option>
                                <option value="2">disable</option>
                            </select>
                        </td>
                        <td><button class ="remove" type = "button">X</button></td>
                    </tr>
                    </table>
                </td>
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

    $(document).ready(function () {
        $("#addmore").click(function () {
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

        $("#add").delegate(".remove", "click", function () {

            $(this).closest("tr").remove()
        });

    });

</script>   

</html>
