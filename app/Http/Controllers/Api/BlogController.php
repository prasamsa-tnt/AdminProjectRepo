<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BlogService;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function __construct(BlogService $blogService){
        $this->blogService=$blogService;
    }

    public function index()
    {  
        // $tags = Tag::all();
        $blogs = Blog::with('category')->with('tags')->with('author')->get();
        return response()->json($blogs,200);
    }
    
    public function store(BlogRequest $request)
    {
        
       try{ 
            {
                $blog=$this->blogService->saveBlog($request);
                $response=[
                    'message'=>'created',
                    'status'=>'success',
                    'data'=>$blog
                ];
                return response()->json($response,200);
            }
        }
            catch(exception $e){
                $response=[
                    'message'=>'error',
                    'status'=>'fail',
                    'data'=>$blog
                ];
                return response()->json($response,400);
        }
    }
    
    public function show(Blog $blog)
    {
        return response()->json(
            [
                'blog'=>$blog
            ]
            );
    }

}
    //    $blog=new Blog;
    //     $blog->name=$request->name;
       
    //     $blog=$category->save();
    //     $response=[
    //         'message'=>'created',
    //         'status'=>'success',
    //         'data'=>$blog
    //     ];
    //     return response()->json($response,200);      
    // }

    // if ($request->user()->id) {
    //     try {
    //     $blog = Blog::create([
    //         'author_id'   => $request->user()->id,
    //         'category_id'   => $category->id,
    //         'blog'    => $request->blog
    //     ]);
    //     $blog->save();
    //     return $blog;
    //     } 
    //     catch(Exception $ex) {
    //         return response()->json(['error', 'Failed to create new user'], 403);
    //     }
    // } 
    // else {
    //     return response()->json(['error', 'Login to rate this book.'], 403);
    // }

    // $blog=new Blog;
    //     $blog->name=$request->name;
    //     $author_id = $request->input('user_id');
    //     $category_id =$request->get('category_id');
    //     $blog=$blog->save();
    //     $response=[
    //         'message'=>'created',
    //         'status'=>'success',
    //         'data'=>$blog
    //     ];
    //     return response()->json($response,200);      
    // }