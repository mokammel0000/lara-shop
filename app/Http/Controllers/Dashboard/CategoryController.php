<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index()
    {
        $cats = Category::all();  //all the resulsts will be showen in the same page

        $cats = Category::paginate(10);

        return view('dashboard.categories.index', compact('cats'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {

        // $this->validate();
        $request->validate([
            'name'=>'required',
            'icon'=>'required',
            'photo'=>'required| mimes:jpg,bmp,png',
        ]);

        // dd($request->all());

        $filePath  = ' ';
        if($request->file('photo')) 
        {
            $fileName =  now()->timestamp . '_' . $request->file('photo')->getClientOriginalName();
            $filePath =  'uploads/' . $fileName;

            $request->file('photo')->move('uploads', $fileName);
            // $request->photo->move('uploads', 'test.jpg');
        }
        $newCategory = new Category();
        $newCategory->name = $request->name;
        $newCategory->icon = $request->icon;
        $newCategory->photo = $filePath;
        $newCategory->save();

        //===========================================================
        //              GO TO A VIEW
        // return view('dashboard.categories.create');
        
        //===========================================================
        //            REDIRECT TO A ROUTE
        // return redirect('/admin/categories/create');
        
        //===========================================================
        //        REDIRECT TO THE LAST ROUTE
        //return back();
        
        //===========================================================
        // REDIRECT TO THE LAST ROUTE WITH A MESSAGE IN A SESSION
        return back()->with('success', 'The New Category has been saved succesfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $selectedCategory = Category::find($id);
        return view('dashboard.categories.edit', compact('selectedCategory'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
            'icon'=>'required'
        ]);


        if($request->hasFile('photo')){
            $fileName =  now()->timestamp . '_' . $request->file('photo')->getClientOriginalName();
            $filePath =  'uploads/' . $fileName;

            $request->file('photo')->move('uploads', $fileName);
        }

        $selectedCategory = Category::find($id);
        $selectedCategory->name = $request->name;
        $selectedCategory->icon = $request->icon;

        if($request->hasFile('photo')){
            $selectedCategory->photo = $filePath;
        }

        $selectedCategory->save();

        // dd($filePath);
        // dd($request->all());

        return back()->with('uploaded', 'The Category has been Uploaded succesfully');
    }

    public function destroy(string $id)
    {
        $selectedCategory = Category::find($id);
        
        Category::destroy($id);

        return back()->with('deleted', 'The '.$selectedCategory->name.' Category has been deleted sucssesfully....');
    }
}
