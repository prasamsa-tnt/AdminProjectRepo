@extends('master')
@section('main')
@extends('layouts.app')

@section('content')

<div class="container-fluid">
<div class="row">
            <div class="col-lg-1 offset-lg-11 margin-tb pull-right" >
                    <a class ="btn btn-primary" href="{{ route('blogs.create')}}">Create </a>
            </div>
        </div>
   <br>
   

   <div class="row">
            <div class="col-lg-12  margin-tb pull-center"  >
                <table class="table table-striped" id='table'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($blogs as $blog)
                        <tr>
                            <td> {{$blog->name}} </td>
                            <td> {{$blog->category->name}} </td>
                            <td> {{$blog->author->name}} </td>
                            <td>
                    <form action="{{route('blogs.destroy',$blog->id)}}" method="post">
                @csrf
                    @method('DELETE')
                    <a class="btn btn-primary" href="{{route('blogs.edit',$blog->id)}}">Edit</a>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    
                    </form>
                    
                </td>
                        </tr>
                @endforeach
                </tbody>
            </table>

    <!-- <form action="" method="post">
                @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                    
                    </form> -->
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

