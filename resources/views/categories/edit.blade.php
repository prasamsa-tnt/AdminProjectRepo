@extends('master')
@section('main')
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-1 offset-lg-11 margin-tb pull-right">
                <a class="btn btn-primary" href="{{route('categories.index')}}">Back</a>
            </div>
        </div>
    
        <div class="row">
            <div class="col-lg-12 margin-tb pull-center">
                <form action="{{ route('categories.update',$category->id) }}" method="post">
                    @csrf   
                    @method('PUT')  

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    
                 
                   
                    
                    <br>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
   
    </div>
@endsection
@endsection