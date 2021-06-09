@extends('header')
@section('main')
<div style="padding: 5px 150px 10px 150px;" class="container">
    <form name="frmAdd" id="frmAdd" action="{{url('/store')}}" method="post" enctype="multipart/form-data">
        <input name="id" value="" type="text" class="form-control" style="display: none;">

        @csrf
        <div class="form-group">
            <label>Name :</label>
            <input name="name" value="" type="text" class="form-control" placeholder="enter name" required>
            <span style="color: red;">@error('name'){{$message}}@enderror</span>
        </div>
        <div class="form-group">
            <label>email:</label>
            <input name="email" value="" type="email" class="form-control" placeholder="enter email" required>
            <span style="color: red;">@error('email'){{$message}}@enderror</span>
        </div>
        <div class="form-group">
            <label>salary:</label>
            <input name="salary" value="" type="" class="form-control" placeholder="enter salary">
            <span style="color: red;">@error('salary'){{$message}}@enderror</span>
        </div>

        <div class="form-group">
            <label>choose image</label>
            <input type="file" name="image" class="form-control" />
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
        getAllState();
        $("#stateid").on('change', function() {
            var state_id = this.value;
            $("#cityid").html('');
            $.ajax({
                url: "http://localhost:8000/api/citybyState/" + state_id,
                type: 'GET',
                success: function(data) {
                    $('#cityid').html('<option value="">Select City</option>');
                    data.forEach(element => {
                        $("#cityid").append('<option value="' + element.id + '">' + element.CityName + '</option>');
                    });
                }
            });
        })
    });

    function getAllState() {
        $.ajax({
            url: "http://localhost:8000/api/state",
            type: 'GET',
            success: function(data) {
                $('#stateid').html('<option value="">Select State</option>');
                data.forEach(element => {
                    $("#stateid").append('<option value="' + element.id + '">' + element.StateName + '</option>');
                });
            }
        });
    }
</script>
@endsection