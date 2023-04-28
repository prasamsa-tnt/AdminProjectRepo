<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table="blogs";
    protected $fillable=[
        'name',
        'category_id',
        'author_id',

    ];
    public function tags(){
        return $this->belongsTo(Tag::class,'blog_tag', 'blog_id', 'tag_id');
    }
    
    public function author(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
