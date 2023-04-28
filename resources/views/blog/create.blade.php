@extends('master')
@section('main')
@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-1 offset-lg-11 margin-tb pull-right">
                <a class="btn btn-primary" href="{{route('blogs.index')}}">Back</a>
            </div>
        </div>
    
        <div class="row">
            <div class="col-lg-12 margin-tb pull-center">
                <form action="{{ route('blogs.store') }}" method="post">
                    @csrf   
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="tag">Tag</label>
                        <select class="select2-multiple form-control" name="tags[]" multiple="multiple">
                         <!-- <option selected>None</option> -->

                            @foreach($tags as $tag)
                            
                            <option value="{{$tag->id}}"> {{$tag->name}}</option>
                            @endforeach
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="category">category</label>
                    <select class="form-control " id="tag" name="category_id">
                        <option selected>None</option>

                            @foreach($categories as $category)
                            <option value="{{$category->id}}"> {{$category->name}}</option>
                            @endforeach
                    </select>
                    </div>


                    
                    <br>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
   
    </div>
    <!-- <script>
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2-multiple').select2({
                placeholder: "Select a tag",
                allowClear: true
            });

        });

    </script> -->
@endsection
@endsection