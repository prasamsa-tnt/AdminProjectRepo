<?php
 namespace App\Http\Requests;
 use Illuminate\Foundation\Http\FormRequest;
 class BlogRequest extends FormRequest{
    public function authorize(){
        return true;
    }
    public function rules(){
        return[
            'name' => 'required',
            'author_id',
            'category_id',
                
           
        ];
    }
 }