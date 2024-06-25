<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // $cats = Category::all();  //all the resulsts will be showen in the same page
        // $cats = Category::get();
        // $cats = Category::where('photo', '!=', 'null')->get();
        // $cats = Category::whereNotNull('photo')->get();
        // $cats = Category::whereNull('photo')->get();
        // $cats = Category::get();


        $cats = Category::paginate(10);

        return view('dashboard.categories.index', compact('cats'));
    }

    public function create()
    {
        // $categories = Category::all();             //there is no condition with it
        // $categories = Category::get();                //if u want to make a condition before fetching data...
        // $categories = Category::where('id', '2')->get();                //if u want to make a condition before fetching data...
        // $categories = Category::where('photo', '!=', 'null')->get();
        // $categories = Category::whereNotNull('photo')->get();
        // $categories = Category::whereNull('photo')->get();

        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {

        // dd($_GET);
        // dd($_POST);
        // dd($request->all()); //get the post and request fields from the form
        // dd($request->getMethod());
        // dd($request->content);

        // $this->validate();
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
            'photo' => 'required| mimes:jpg,bmp,png',
        ]);

        $filePath  = ' ';
        if($request->file('photo')) {
            $fileName =  now()->timestamp . '_' . $request->file('photo')->getClientOriginalName();
            $filePath =  'uploads/' . $fileName;

            $request->file('photo')->move('uploads', $fileName);
            // $request->photo->move('uploads', 'test.jpg');
        }

        // $newCategory = new Category();
        // $newCategory->name = $request->name;
        // $newCategory->icon = $request->icon;
        // $newCategory->photo = $filePath;
        // $newCategory->save();

        //------------------------------------------------
        //INSERT USING MASS ASSINGMENT

        $inputs = $request->all();
        $inputs['photo'] = $filePath;
        $newCategory = Category::create($inputs);

        //===========================================================
        //              GO TO A VIEW
        // return view('dashboard.categories.create');
        // return view('dashboard.slider.index', compact('slides'));

        //===========================================================
        //            REDIRECT TO A ROUTE
        // return redirect('/admin/categories/create');
        // return redirect('/admin/slides')->with('success', 'The New Slide has been saved succesfully');

        //===========================================================
        //        REDIRECT TO [THE LAST] ROUTE
        //return back();
        return back()->with('success', 'The New Category has been saved succesfully');
    }

    public function show(Category $category)
    {
        return view('dashboard.categories.show', compact('category'));
    }

    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'required'
        ]);


        if($request->hasFile('photo')) {
            $fileName =  now()->timestamp . '_' . $request->file('photo')->getClientOriginalName();
            $filePath =  'uploads/' . $fileName;

            $request->file('photo')->move('uploads', $fileName);
        }

        // $category = Category::find($id);
        // $category->name = $request->name;
        // $category->icon = $request->icon;

        // if($request->hasFile('photo')){
        //     $category->photo = $filePath;
        // }

        // $category->save();


        //------------------------------------------------
        //UPDATING USING MASS ASSINGMENT

        // $category = Category::find($id);   //we don't need it because we have used Model Bind
        $inputs = $request->all();
        if($request->hasFile('photo')) {
            $inputs['photo'] = $filePath;

        }
        $category->update($inputs);

        return back()->with('uploaded', 'The Category has been Uploaded succesfully');
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);

        Category::destroy($id);

        return back()->with('deleted', 'The '.$category->name.' Category has been deleted sucssesfully....');
        // return redirect()->back()->withErrors($validator)->withInput();
    }
}
