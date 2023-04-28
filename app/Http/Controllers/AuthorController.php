<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    { 
        // dd('hello');
        $authors=User::all();
        return view('author.index',compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('hello');
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
           
        ]);
        User::create($request->post());

        return redirect()->route('authors.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $author)
    {
        return view('author.show',compact('author'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $author)
    {
        return view('author.edit',compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $author)
    {
        $request->validate([
            'name' => 'required',
            
        ]);
        
        $author->fill($request->post())->save();

        return redirect()->route('authors.index');
  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $author)
    {
        $author->delete();
        return redirect()->route('authors.index');
   
    }
}
