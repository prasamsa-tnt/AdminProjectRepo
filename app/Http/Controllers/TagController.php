<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags=Tag::all();
        return view('tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required',
           
        ]);
        Tag::create($request->post());

        return redirect()->route('tags.index');
   
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
         return view('tags.show',compact('tag'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
         return view('tags.edit',compact('tag'));
  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
          $request->validate([
            'name' => 'required',
            
        ]);
        
        $tag->fill($request->post())->save();

        return redirect()->route('tags.index');
  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
         $tag->delete();
        return redirect()->route('tags.index')->with('success','Deleted successfully');
   
    }
}
