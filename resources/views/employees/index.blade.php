@extends('master')
@section('main')
@extends('layouts.app')

@section('content')


<div class="container-fluid">

    <div class="row">
            <div class="col-lg-12  margin-tb pull-center" >
                <table class="table table-striped" id="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>job</th>
                        <th>address</th>

                    </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{$employee->name ?? ''}}</td>
                    <td>{{$employee->job}}</td>
                    <td>{{$employee->address}}</td>
</tr>
@endforeach
                </tbody>
            </table>

</div>
</div>
    </div>

@endsection
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>
@endsection


