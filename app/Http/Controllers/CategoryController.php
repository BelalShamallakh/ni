<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('parent')->orderBy('id', 'desc')->paginate(10);
        return view('admin.categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //validate input
        $request->validate([
            'name'=>'required',
            'image'=>'required',
            'parent_id'=>'nullable|exists:categories,id',

        ]);

         //upliad the file
        $new_image = rand().rand().time().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/images'),$new_image);

        //save date to database
        Category::create([
            'name'=>$request->name,
            'image'=>$new_image,
            'parent_id'=>$request->parent_id,
        ]);

        return redirect()->route('admin.categories.index')->with('msg','category','created')->with('type','success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all();
        return view('admin.categories.edit',compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
               //validate input
               $request->validate([
                'name'=>'required',
                'image'=>'nullable',
                'parent_id'=>'nullable|exists:categories,id',
            ]);

            $category = Category::findOrFail($id);
            $new_image = $category->image;

             //upload the file
            if($request->hasFile('image')){
                $new_image = rand().rand().time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/images'),$new_image);
            }
    
            //save date to database
            $category->update([
                'name'=>$request->name,
                'image'=>$new_image,
                'parent_id'=>$request->parent_id,
            ]);
    
            return redirect()->route('admin.categories.index')->with('msg','category','updated')->with('type','info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        //Delete image

        if(file_exists(public_path('uploads/images/'.$category->image))){

            File::delete(public_path('uploads/images/'.$category->image));
        }

        //Set parent id to null
        Category::where('parent_id',$category->id)->update(['parent_id'=>null]);

        //Delete item
        $category->delete();

        return redirect()->route('admin.categories.index')->with('msg','Category Delate')->with('type','danger');


    }
}
