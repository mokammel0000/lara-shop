<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Photo;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    // in INDEX , SHOW and EDIT we use RELATEIONS
    public function index()
    {
        // $products = Product::paginate(10);
        $products = Product::with(['category'])->paginate(10);
        return view('dashboard.products.index', compact('products'));
    }

    
    public function create()
    {
        // $categories = Category::all();             //there is no condition with it
        $categories = Category::get();                //if u want to make a condition before fetching data...
        // $categories = Category::where('id', '2')->get();                //if u want to make a condition before fetching data...
        // $categories = Category::where('photo', '!=', 'null')->get();
        // $categories = Category::whereNotNull('photo')->get();
        // $categories = Category::whereNull('photo')->get();
        return view('dashboard.products.create', compact('categories'));
    }         

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', 
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'numeric',
            'stock' => 'numeric', 
            'photo' => 'requierd'
        ]);

        // dd($request->all());
        // dd($request->file('photos'));


        // Storing the product in the Product Model...

        $inputs = $request->all();
        $inputs['sku'] = '';   //we have added the SKU using events, look at the products model...
        // $newProduct = Product::create($request->all());
        $newProduct = Product::create($inputs);
        
        
        // Storing photos in the Photo Model...
        
        if($request->hasFile('photos')){
            foreach ($request->file('photos') as $photo) {
                $fileName =  now()->timestamp . '_' . $photo->getClientOriginalName();
                $filePath =  'uploads/products/' . $fileName;
                $photo->move('uploads/products', $fileName);


                Photo::create([
                    'name' => $fileName, 
                    'path' => $filePath, 
                    'product_id' => $newProduct->id, 
                ]);
            }
        }
    
        return back()->with('success', 'Product has been added succsessfully');
    }

    
    public function show(Product $product)
    {
        // laravel already fetch the product for u, u need now to load the relation 
        
        $product->load(['category', 'photos']);
        // dd($product);
        return view('dashboard.products.show', compact('product'));
    }

    
    public function edit(Product $product)
    {
        $product->load(['category', 'photos']);
        $categories = Category::get();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required', 
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'numeric',
            'stock' => 'numeric'
        ]);

        // dd($request->all());

        
        $product->update($request->all());

        if($request->hasFile('photos')){
            foreach ($request->file('photos') as $photo) {
                $fileName =  now()->timestamp . '_' . $photo->getClientOriginalName();
                $filePath =  'uploads/products/' . $fileName;
                $photo->move('uploads/products', $fileName);


                Photo::create([
                    'name' => $fileName, 
                    'path' => $filePath, 
                    'product_id' => $product->id, 
                ]);
            }
        }    
        
        return back()->with('uploaded', 'The Category has been Uploaded succesfully');
    }

   
    public function destroy($id)
    {
        $product = Product::find($id);
        Product::destroy($id);

        return back()->with('deleted', 'The Product '.$product->name.'has been deleted succesfully');        
    }
}
