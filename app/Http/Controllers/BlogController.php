<?php

namespace App\Http\Controllers;
use App\Models\Blog;

use App\Models\User;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Subcategory;

use Session;
use Illuminate\Http\Request;

use App\Services\BlogService;
use App\Http\Requests\BlogRequest;


class BlogController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function __construct(BlogService $blogService){
        $this->blogService = $blogService;
    }
    public function index(Request $request)
    { 
        $tags = Tag::all();
        $blogs = Blog::with('category')->with('author')->get();
        return view('blog.index', compact('blogs','tags'));
  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        

        $tags = Tag::all();
        $categories = Category::all();
        $subcategories=Subcategory::all();
        // $subcategories =  Subcategory::select('name','id')->where('category_id',$request->category_id)->get();

        // $subcategories =  Category::where("category_id",$request->category_id)->with('subcategories')->get();
        // dd($subcategories);
        
       return view('blog.create')->with('tags', $tags)->with('categories', $categories)->with('subcategories',$subcategories);
    }
    public function fetchsubcategory($category_id = null){
        $subcategories =  Subcategory::where('category_id',$category_id)->get();
        // dd($subcategories);
        $response=[
            'status'=>1,
            'subcategories'=>$subcategories
        ];
        return response()->json($response);

    }

    // public function getSubcategory(Request $request) {
    //     if ($request->categoryId) {
    //         $subcategories = Subcategory::where('category_id', $request->categoryId)->get();
    //         if ($subcategories) {
    //             return response()->json(['status' => 'success', 'data' => $subcategories], 200);
    //         }
    //         return response()->json(['status' => 'failed', 'message' => 'No subcategories$subcategories found'], 404);
    //     }
    //     return response()->json(['status' => 'failed', 'message' => 'Please select category'], 500);
    // }
    public function store(BlogRequest $request)
    {
        try{
          
            $this->blogService->saveBlog($request);
            $redirect=redirect()->route("blogs.index");
            return $redirect->with(['success'=>"blog added",]); 
        }
        catch(exception $e){
            $redirect=redirect()->route("blogs.index");
            return $redirect->with(['errror',"something went wrong",]);
        }

        //         $author=User::where('email','=',$request->email)->first();
        //     if($author){
        //     $request->Session()->put('loginId',$author->id);
        //     }
        //     $author_id=Session::get('loginId');
        // $request->validate([
        //         // request ma
        //         'name' => 'required',
        //         'category_id',
        //         'author_id'=> $author_id,
                
        //     ]);
            
            // return view('dashboard', compact('data'));
            // $blog= new Blog();
            //  $blog->name= $request['name'];
            // $blog->author_id=$request['email'];
            //    $blog->save();
        //     $blog= Blog::create($request->post());
        //     // dd($tags);
        //     $tags= $request->post('tag');
        //     foreach( $tags as $tag)
        //   {
        //      $blog->tags()->attach($tag);
        //   }

        //     return redirect()->route('blogs.index',compact('author_id'));
        // 
    }
       

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blog.show',compact('blog'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('blog.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required',
            
            'author_id',
            'category_id',
        ]);
        
        $blog->fill($request->post())->save();

        return redirect()->route('blogs.index');
  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index');
   
    }
}
