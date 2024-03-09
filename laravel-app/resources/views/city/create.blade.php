<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>City Create Page</title>
</head>
<body>
    <h2>City Create Page</h2>
    <form action="{{route('city.store')}}" method="POST">
        @csrf
        <table>
            <tr>
                <td>Country Id:</td>
                <td><select name="country_id" id="countryId">
                    <option value="">select Countay</option>
                    @foreach ($countryData as $_countryData)
                    <option value="{{$_countryData->id }}">{{$_countryData->name}}</option>
                        
                    @endforeach
                </select></td>
            </tr>
            <tr>
                <td>State Id:</td>
                <td>
                  <select name="state_id" id="stateId">
                    <option value="">Select State</option>
                    @foreach ($StateData as $_state)
                    <option value="{{$_state->id }}">{{$_state->state}}</option>
                        
                    @endforeach
                  </select>
                </td>
            </tr>
            <tr>
                <td>City Name:</td>
                <td>
                    <input type="text" name="city_name" >
                </td>
            </tr>
            <tr>
                <td>City Status</td>
                <td>
                    <select name="city_status" id="">
                        <option value="">action</option>
                        <option value="1">enable</option>
                        <option value="2"> disble</option>
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
    <script>
		$(document).ready(function(){
			$("#countryId").change(function(){
				var ctId = $(this).val();
				// console.log(ctId);
				$.ajax({
					url: '{{ route("country-state") }}',
					type: 'GET',
					data: {'ct_id': ctId},
					success: function(request) {
						// console.log(request);
						$("#stateId").html(request);
					},
					error: function (er) {
						alert(er);
					}
				});
			});
		});
	</script>
</body>
</html>