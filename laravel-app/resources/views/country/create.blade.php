<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Countay Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h2>country</h2>
    <form action="{{route('country.store')}}" method="POST" id ="form">
        @csrf
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" ></td>
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
                <td>states:</td>
                <td>
                    <table id="add">
                        <tr>
                            <th>Name</th>
                            <th>status</th>
                            <td></td>
                            <td><button type="button" id="addmore">+</button></td>
                        </tr>
                        <tr>
                          <td>
                            <input type="text" name ="state_name[]">
                          </td>
                          <td>
                            <select name ="state_status[]">
                                <option value="">action</option>
                                <option value="1">Enable</option>
                                <option value="2">disable</option>
                            </select>
                          </td>
                          <td></td>
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
            <td></td><td><button class ="remove" type = "button">X</button></td>\
        </tr>'
                $('#add').append(add_more);
            });

            $("#add").delegate(".remove", "click", function () {

                $(this).closest("tr").remove()
            });

        });

    </script>   
</body>
</html>