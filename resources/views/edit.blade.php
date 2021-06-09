@extends('header')
@section('main')
<div style="padding: 5px 150px 10px 150px;" class="container">
    <form name="frmAdd" id="frmAdd" action="{{url('/update')}}" method="post" enctype="multipart/form-data">
        <input name="id" value="{{$data->id}}" type="text" class="form-control" style="display: none;">

        @csrf
        <div class="form-group">
            <label>Name :</label>
            <input name="name" id="name" type="text" class="form-control" placeholder="enter name" required>
            <span style="color: red;">@error('name'){{$message}}@enderror</span>
        </div>
        <div class="form-group">
            <label>email:</label>
            <input name="email" id="email" type="email" class="form-control" placeholder="enter email" required>
            <span style="color: red;">@error('email'){{$message}}@enderror</span>
        </div>
        <div class="form-group">
            <label>salary:</label>
            <input name="salary" id="salary" type="" class="form-control" placeholder="enter salary">
            <span style="color: red;">@error('salary'){{$message}}@enderror</span>
        </div>

        <div class="form-group">
            <label>choose image</label>
            <input type="file" name="image" id="image" class="form-control" />
        </div>
        <div class="form-group">
            <label>State Name</label>
            <select name="stateid" id="stateid" class="form-control" required>
            </select>
        </div>
        <div class="form-group">
            <label>City Name</label>
            <select name="cityid" id="cityid" class="form-control" required>
            </select>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <input type="submit" class="btn btn-info" value="Save">
                <input type="reset" class="btn btn-warning" value="Reset">
            </div>
        </div>
    </form>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#frmAdd").validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true
                },
                salary: {
                    required: true,
                    number: true,
                },
                image: {
                    required: true,
                },
                stateid: {
                    required: true,
                },
                cityid: {
                    required: true,
                },
            },
            // Specify the validation error messages
            messages: {
                name: {
                    required: "Required"
                },
                email: {
                    required: 'Enter valid email'
                },
                salary: {
                    required: 'Enter number only'
                },
                stateid: {
                    required: 'Select State'
                },
                cityid: {
                    required: 'Select City'
                },
                image: {
                    required: 'Please select profile image to upload'
                }
            }
        });
        var urlParams = window.location.pathname.replace("edit", "").replace("/", "").replace("/", "");
        getUserData(urlParams);

        $("#stateid").on('change', function() {
            var state_id = this.value;
            $("#cityid").html('');
            bindCityByState(stateId, 0);
        })
    });

    function bindCityByState(stateId, selectedValue) {
        $.ajax({
            url: "http://localhost:8000/api/citybyState/" + stateId,
            type: 'GET',
            success: function(data) {
                $('#cityid').html('<option value="">Select City</option>');
                data.forEach(element => {
                    if (element.id == selectedValue) {
                        $("#cityid").append('<option selected value="' + element.id + '">' + element.CityName + '</option>');

                    } else {
                        $("#cityid").append('<option value="' + element.id + '">' + element.CityName + '</option>');

                    }

                });
            }
        });
    }

    function getAllState(selectedValue) {
        $.ajax({
            url: "http://localhost:8000/api/state",
            type: 'GET',
            success: function(data) {
                $('#stateid').html('<option value="">Select State</option>');
                data.forEach(element => {
                    if (element.id == selectedValue) {
                        $("#stateid").append('<option  selected value="' + element.id + '">' + element.StateName + '</option>');

                    } else {
                        $("#stateid").append('<option value="' + element.id + '">' + element.StateName + '</option>');

                    }
                });
            }
        });
    }

    function getUserData(id) {
        $.ajax({
            url: "http://localhost:8000/api/getEmployeeById/" + id,
            type: 'GET',
            success: function(data) {
                debugger
                $("#name").val(data.name);
                $("#email").val(data.email);
                $("#salary").val(data.salary);
                getAllState(data.stateid);
                bindCityByState(data.stateid, data.cityid)
            }
        });
    }
</script>
@endsection