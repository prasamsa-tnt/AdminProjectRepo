@extends('master')
@section('main')
@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row">
            <div class="col-lg-1 offset-lg-11 margin-tb pull-right" >
                    <a class ="btn btn-primary" href="{{ route('authors.create')}}">Create </a>
            </div>
        </div>
   <br>
   <div class="row">
            <div class="col-lg-12  margin-tb pull-center" >
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($authors as $author)
                        <tr>
                            <td> {{$author->name}} </td>
                            <td> {{$author->email}} </td>
                            <td>
                    <form action="{{route('authors.destroy',$author->id)}}" method="post">
                @csrf
                    @method('DELETE')
                    <a class="btn btn-primary" href="{{route('authors.edit',$author->id)}}">Edit</a>
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
@endsection

