@extends('master')
@section('main')
@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row">
            <div class="col-lg-1 offset-lg-11 margin-tb pull-right" >
                    <a class ="btn btn-primary" href="{{ route('tags.create')}}">Create </a>
            </div>
        </div>
   <br>
   <div class="row">
            <div class="col-lg-12  margin-tb pull-center" >
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($tags as $tag)
                        <tr>
                            <td> {{$tag->name}} </td>
                            <td>
                    <form action="{{route('tags.destroy',$tag->id)}}" method="post">
                @csrf
                    @method('DELETE')
                    <a class="btn btn-primary" href="{{route('tags.edit',$tag->id)}}">Edit</a>
                    <button type="submit" class="btn btn-danger">Delete</button>
                    
                    </form>
                    
                </td>
                        </tr>
                @endforeach
                </tbody>
            </table>

  
</div>
</div>
    </div>
@endsection
@endsection

