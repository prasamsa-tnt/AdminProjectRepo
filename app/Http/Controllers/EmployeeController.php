<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use DataTables;
use Illuminate\Http\Request;
use App\Services\EmployeeService;
use App\Http\Requests\EmployeeRequest;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $employees=Employee::all();
        //  return view('employees.index',compact('employees'));

        return response()->json([
                'employees'=>Employee::get()
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('employees.create');

    // }

   
    public function store(Request $request)
    {
        // try{
          
        //     $this->EmployeeService->saveEmployee($request);
        //     $redirect=redirect()->route("employees.index");
        //     return $redirect->with(['success'=>"blog added",]); 
        // }
        // catch(exception $e){
        //     $redirect=redirect()->route("employees.index");
        //     return $redirect->with(['errror',"something went wrong",]);
        // }
        $employee=new Employee;
        $employee->name=$request->name;
        $employee->job=$request->job;
        $employee->address=$request->address;
        $employee->save();
        return response()->json(
            [
                'message'=>'created',
                'status'=>'success',
                'data'=>$employee
            ],200
            );
    }
    public function getEmployees(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    
    public function show(Employee $employee)
    {
        return response()->json(
            [
                'employee'=>$employee
            ]
            );
    }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $id)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         //
//     }
}
