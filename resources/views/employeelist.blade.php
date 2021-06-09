@extends('header')
@section('main')

<div class="container">
    <div class="content">
        <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6" style="text-align: right;">
                <a href="{{ url('/add/') }}" class="btn btn-sm btn-warning">Add Employee</a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered">
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Salary</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Image</th>

                        <th width="280px">Action</th>

                    </tr>
                    <?php $number = 0; ?>
                    @foreach ($datas as $dt)
                    <tr>
                        <td>{{ $number }}</td>
                        <?php $number++; ?>
                        <td>{{ $dt->name }}</td>
                        <td>{{ $dt->email }}</td>
                        <td>{{ $dt->salary }}</td>
                        <td>{{ $dt->StateName }}</td>
                        <td>{{ $dt->CityName }}</td>
                        <td>
                            @if($dt->image!='')
                            <img src="/image/{{ $dt->image }}" width="50px" height="50px">
                            @endif

                        </td>
                        <td>
                            <input type="button" class="btn btn-sm btn-danger" value="Delete" id="btnDelete" onclick="deleteEmployee('{{$dt->id}}');">
                            <a href="{{ url('/edit/'.$dt->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

    });

    function deleteEmployee(id) {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this employee!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "http://localhost:8000/api/deleteEmployee/" + id,
                        type: 'get',
                        success: function(data) {
                            swal("Poof! Your imaginary file has been deleted!", {
                                icon: "success",
                            });
                            location.reload();
                        }
                    });

                } else {}
            });
    }
</script>
@endsection