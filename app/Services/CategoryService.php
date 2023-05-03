<?php
namespace App\Services;

use App\Models\Category;

// use App\Services\blogService;
// use Illuminate\Http\Request;

class CategoryService{
     public function getAllCategory(){
           return Category::get();
        // this->blogserve=$blogService;

    }
   
    public function saveCategory($request){
     
      
    $postData=[
        'name'=>$request->get('name'),
           

    ];
   $category= Category::create($postData);
    return $category;
}

}