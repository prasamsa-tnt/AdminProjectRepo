<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\CategoryService;
use App\Http\Requests\CategoryRequest;
class CategoryController extends Controller
{
    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }
    public function index()
    { 
        $categories=Category::all();
        return response()->json($categories,200);
    }
    
    public function store(CategoryRequest $request)
    {
        try{          
            $category=$this->categoryService->saveCategory($request);
            $response=[
                'message'=>'created',
                'status'=>'success',
                'data'=>$category
            ];
            return response()->json($response,200);
        }
        catch(exception $e){
            $response=[
                'message'=>'error',
                'status'=>'fail',
                'data'=>$category
        ];
        return response()->json($response,400);
        }



    //     $request->validate([
    //         'name' => 'required',
               
    //     ]);
    //    $category=new Category;
    //     $category->name=$request->name;
       
    //     $category=$category->save();
    //     $response=[
    //         'message'=>'created',
    //         'status'=>'success',
    //         'data'=>$category
    //     ];
    //     return response()->json($response,200);      
    }
    public function show(Category $category)
    {
        return response()->json(
            [
                'category'=>$category
            ]
            );
    }
}
