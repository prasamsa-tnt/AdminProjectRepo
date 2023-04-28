<?php
namespace App\Services;
use Session;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\BlogTag;

// use App\Services\blogService;
// use Illuminate\Http\Request;

class BlogService{
     public function getAllBlog(){
           return Blog::get();
        // this->blogserve=$blogService;

    }
   
    public function saveBlog($request){
     
        $user = auth()->user();
// dd($user);
$authorId = auth()->user()->id;
// dd($authorId);
    // $authorId=Session::get('loginId');
    // dd($authorId);
    $postData=[
        'name'=>$request->get('name'),
        'category_id'=>$request->get('category_id'),
        'author_id'=>$authorId,
    ];
    // Blog::create($postData);
    $tags= $request->post('tags');
    // dd($tags);
    // $blog=
    Blog::create($postData);
    // foreach( $tags as $tag)
    // {
    //    $blog->tags()->attach($tag);
    // }
}

}