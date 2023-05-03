@extends('master')
@section('main')

<div class="container-fluid">
<!-- <div class="row">
            <div class="col-lg-1 offset-lg-11 margin-tb pull-right">
                <a class="btn btn-primary" href="{{route('students.store')}}">Back</a>
            </div>
        </div> -->
        <div class="row">
            <div class="col-lg-12 margin-tb pull-center">
                <form action="" method="post" id="form">

                    @csrf   

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    <span class="name_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" id="email" name="name" class="form-control">
                        <span class="email_err"></span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                      
                        <input type="text" id="password" name="name" class="form-control">
                        <span class="password_err"></span>
                    </div>
                   
                    <br>
                    <input type="submit" id='submit' value="Submit">

                    <!-- <button id='submit' type="button" class="btn btn-success">Submit</button> -->
                </form>
            </div>
        </div>
   
    </div>
    <script >
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        

        $(document).ready(function(){
            
            $("#form").submit(function(e)
            // $("#form").on('click','#submit',function(e)

            {

                e.preventDefault();
                // var _token=$("input[name='_token']").val();
                var name=$('#name').val();
                var email=$('#email').val();
                var password=$('#password').val();
               
                // var data={
                //     'name':$('#name').val(),
                //     'email':$('#email').val(),
                //     'password':$('#password').val(),
                // }
                // var formdata=$('form').serializeArray();
                // console.log(formdata);
                $.ajax({
                    type:'POST',
                    url: "{{ route('students.store') }}",
                    dataType:'json',
                    data:{name:name,email:email,password:password},
                    success:function(data){
                        console.log(data);
                        if($.isEmptyObject(data.error)){
                            alert(data.success);
                        }
                        else{
                            $.each(data.error,function(key,value){
                            console.log(key);
                            $('.'+key+'_err').text(value);
                         })
                            // printError(data.error);
                        }
                    }
                });
            });
        //   function printError(msg){
        //     $.each(msg,function(key,value){
        //         console.log(key);
        //         $('.'+key+'_err').text(value);
        //     })
        //   }
        });
    </script>
@endsection
    

