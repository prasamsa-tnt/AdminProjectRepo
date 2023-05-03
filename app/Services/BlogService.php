<?php
namespace App\Services;
use Session;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\BlogTag;
use Illuminate\Support\Facades\Auth;

// use App\Services\blogService;
// use Illuminate\Http\Request;

class BlogService{
     public function getAllBlog(){
           return Blog::get();
        // this->blogserve=$blogService;

    }
   
    public function saveBlog($request)
    {
        // Get the currently authenticated user...
        $user = Auth::user();
 
        // Get the currently authenticated user's ID...
        $authorId = Auth::id();
        // dd($user);
        //    $user = auth()->user();
        // $authorId = auth()->user()->id;
        
        $postData=[
            'name'=>$request->get('name'),
            'category_id'=>$request->get('category_id'),
            'author_id'=>$authorId,
        ];
        $tags= $request->post('tags');
        $blog=Blog::create($postData);
        return $blog;

        // foreach( $tags as $tag)
        // {
        //    $blog->tags()->attach($tag);
        // }
    }

}