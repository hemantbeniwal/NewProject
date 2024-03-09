<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>City Edit page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h2>City Edit page</h2>
    <form action="{{route('city.update', $city->id)}}" method="POST">
        @csrf
        @method('PUT')
        <table>
            <tr>
                <td>Countay Name:</td>
                <td>
                    <select name="country_id" id="countryId">
                        @foreach ($countrys as $_countryData)
                        <option value="{{$_countryData->id }}"{{($city->country_id == $_countryData->id)?'selected':null}}>{{$_countryData->name}}</option>
                            
                        @endforeach
    
                    </select>
                </td>
            </tr>
            <tr>
                <td>State Name:</td>
                <td>
                    <select name="state_id" id="stateId">
                        @foreach ($state as $_state)
                        <option value="{{$_state->id }}"{{($city->state_id == $_state->id)?'selected':null}}>{{$_state->state}}</option>
                            
                        @endforeach
    
                    </select>
                </td>
            </tr>
            <tr>
                <td>City Name:</td>
                <td><input type="text" name="city_name" value="{{$city->city_name}}"></td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>
                    {{-- ($_country["country_status"] == 1) ? "selected" : null --}}
                    <select name="status">
                        <option value="enable"{{($city->city_status  == 'enable')? "selected": null}}>Enable</option>
                        <option value="disable"{{($city->city_status == 'disable')? "selected": null}}>Disable</option>
                    </select>
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
    $(document).ready(function(){
        $('#country_id').change(function(){
            var ctId = $(this).val();
            // console.log("Country data:" + ctId);
            $.ajax({
                url: "{{ route('country-state') }}",
                type: 'GET',
                data: {'couId': ctId},
                success: function(data) {
                    // console.log(data);
                    $('#state_id').html(data);
                },
                error: function(er) {
                    alert(er);
                }
            });

        });
    });
</script>

</html>