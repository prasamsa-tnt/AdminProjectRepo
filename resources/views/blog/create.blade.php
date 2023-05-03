<!-- @extends('master')
@section('main') -->
@extends('layouts.app')

@section('content')
<meta name="_token" content="{{ csrf_token() }}">
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
                        <select class="form-control select2-multiple" name="tags[]" multiple="multiple" id="select2Multiple">
                         <!-- <option selected>None</option> -->

                            @foreach($tags as $tag)
                            
                            <option value="{{$tag->id}}"> {{$tag->name}}</option>
                            @endforeach
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="category">category</label>
                    <select class="form-control " id="category" name="category_id" data-dependent="subcategory">
                        <option selected>Select category</option>

                            @foreach($categories as $category)
                            <option value="{{$category->id}}"> {{$category->name}}</option>
                            @endforeach
                    </select>
                    </div>
                   

                    <div class="form-group">
                        <label for="Subcategory">Subcategory</label>
                    <select class="form-control " id="subcategory" name="subcategory">
                    <option value="">Select subcategory</option>
                    </select>
                    </div>
                    
                    <br>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
   
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

 
    <script>
        $(document).ready(function() {
            // Select2 Multiple
            $('.select2-multiple').select2({
                placeholder: "Select a tag",
                // multiple:true,
                allowClear: true
            });

        });

    </script>

    <script
  src="https://code.jquery.com/jquery-3.6.4.js"
  integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
  crossorigin="anonymous"></script>


   <script>

$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});
        $(document).ready(function () {
            $("#category").change(function () {
                var category_id = $(this).val();
                if(category_id==0){
                    var category_id=0;
                }
                // console.log(category_id);
                
                $.ajax({
                    url: '{{ url ("/fetchsubcategory/") }}/'+category_id,
                    type: 'POST',
                    dataType:'json',
                    // data: {
                    //     category_id: category_id,
                    //     // _token: '{{csrf_token()}}'
                    // },
                        success: function (response) {

                            // console.log(response);
                            $('#subcategory').find('option:not(:first)').remove();
                          
                            if(response['subcategories'].length > 0){
                                $.each(response['subcategories'],function(key,value){
                                    $("#subcategory").append("<option id='"+value['id']+"'> "+ value['name'] + "</option>");
                                });
                            }
                            else{
                                 
                            }
                        }
                    
                });
            });
        });


        
        </script>
        
@endsection
<!-- @endsection -->