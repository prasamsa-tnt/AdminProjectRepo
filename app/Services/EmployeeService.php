<?php
namespace App\Services;

use App\Models\Employee;

// use App\Services\blogService;
// use Illuminate\Http\Request;

class EmployeeService{
     public function getAllEmployee(){
           return Employee::get();
        // this->blogserve=$blogService;

    }
   
    public function saveEmployee($request){
     
      
    $postData=[
        'name'=>$request->get('name'),
        'job',
        'address',     

    ];
     Employee::create($postData);
    
}

}