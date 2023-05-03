<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
        $students=Student::all();
        return view('students.index',compact('students'));
         }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:students',
            'password'=>'required',
        ]);
        // if ($validation->fails()) {
        //     return response()->json(['code' => 400, 'msg' => $validation->errors()->first()]);
        // }
        // else{
        // $student=new Student;
        //     $student->name=$request->input('name');
        //     $student->email=$request->input('email');
        //     $student->password=bcrypt($request->input('password'));
        //     $student->save();
        // return response()->json([
        //     'code' => 200, 
        //     'msg' => 'Thanks for contacting us, we will get back to you soon.'
        // ]);
        // }
        // if ($validator->passes()) {

        //     return response()->json(['status'=>200,'success'=>'Added new records.']);
            
        // }

        // return response()->json(['status'=>400,'error'=>$validator->errors()]);
       
        
        if($validator->fails()){
            return response()->json([
                'status'=>400,
                'error'=>$validator->errors()
                // 'errors'=>$validator->messages(),
            ]);
        }
        else{
            $student=new Student;
            $student->name=$request->input('name');
            $student->email=$request->input('email');
            $student->password=bcrypt($request->input('password'));
            $student->save();
            return response()->json([
                'status'=>200,
                // 'message'=>'success',
                'success'=>'Data stored'
            ]);


        }
    }
   
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
