
@extends('master')
@section('main')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-1 offset-lg-11 margin-tb pull-right" >
            <button type="button" id="create" class="btn btn-success" data-toggle="modal" data-target="#myModal" >Create</button>     
        </div>
    </div>
        
    <div class="modal" tabindex="-1" role="dialog" id="myModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div id="res" ></div>

                <form action="" id="form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add students</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" >
                    <span id="error_message" class="text-danger"></span>  
                    <span id="success_message" class="text-success"></span>  

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
                        <input type="password" id="password" name="name" class="form-control">
                        <span class="password_err"></span>
                    </div>
                    <br>
                </div>
                    <div class="modal-footer">
                        <button type="button" id ="save" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
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
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td> {{$student->name}} </td>
                        <td> {{$student->email}} </td>
                        
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
<script >
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $("#create").on('click',function(){
        $("#form").trigger('reset');
    });
    
    $(document).ready(function(){
        $("#save").click(function(e){
            e.preventDefault();
            var name=$('#name').val();
            var email=$('#email').val();
            var password=$('#password').val();
            
            $.ajax({
                type:'POST',
                url: "{{ route('students.store') }}",
                dataType:'json',
                data:{name:name,email:email,password:password},
                success:function(data){
                    console.log(data);
                    if($.isEmptyObject(data.error)){
                        // alert("data.success")
                        $('#success_message').html("Data stored successfully");
                        $('#form').modal('show');
                            // set timeout to close modal after 5 seconds (5000 milliseconds)
                            setTimeout(function() {
                            $('#form').modal('hide');
                            location.reload();
                            },1000);
                    }
                    else{
                        $.each(data.error,function(key,value){
                        // console.log(key);
                        $('.'+key+'_err').text(value);
                        })
                    }
                }
            });
        });
    
    });
</script>
@endsection


