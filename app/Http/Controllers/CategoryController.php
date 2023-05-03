<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
// namespace App\Http\Controllers\API\ApiCategoryController;

use App\Services\CategoryService;
use App\Http\Requests\CategoryRequest;
class CategoryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    { 
        // dd('hello');
        $categories=Category::all();
        return view('categories.index',compact('categories'));

        // return response()->json($categories,200);
    }

    /**
     * Show the form for creating a new resource.
     */    
    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;
    }
    public function create()
    {
        // dd('hello');
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        // dd('fdrf');
        try{
          
            $this->categoryService->saveCategory($request);
            $redirect=redirect()->route("categories.index");
            return $redirect->with(['success'=>"category added",]); 
        }
        catch(exception $e){
            $redirect=redirect()->route("categories.index");
            return $redirect->with(['errror',"something went wrong",]);
        }
        // $request->validate([
        //     'name' => 'required',
           
        // ]);
        // Category::create($request->post());

        // return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show',compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $category->fill($request->post())->save();

        return redirect()->route('categories.index');
  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success','Deleted successfully');
   
    }
}
