<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show($id)
    {

        $ratings_for_the_post = [];
        $reviews = ProductReview::where('user_id', auth()->id())->where('product_id', $id)->get();
        foreach ($reviews as $product_review) {
            if(isset($product_review->rating)) {
                array_push($ratings_for_the_post, $product_review->rating);
            }
        }
        $is_rated_previously = !empty($ratings_for_the_post);


        // $product = product::with([
        //     'category',
        //     'photos',
        //     'user' => function (Builder $query) {
        //         $query->wherePivotNotNull('comment');
        //         }])
        //     ->withCount(['user' => function (Builder $query) {
        //         $query->whereNotNull('rating');
        //         }])
        //     ->find($id);

        $product = product::with(['category','photos'])
            ->with(['user' => function (Builder $query) {
                $query->where('comment', '!=', 'Null');
            }])
            ->withCount(['user' => function (Builder $query) {
                $query->where('rating', '!=', 'Null');
            }])
            ->find($id);

        // $product here doesn't include all the records on product_user table,
        // it's only include the records which comment attribute is not null,
        // so, we can't calculate the product rate with this value
        // we must create a new varible that have all product records which have a rating value


        // dd($product);                 // product + it's attributes + it's relations + the pivot attributes for each relation
        // dd($product->category);    // the category relation and it's attributes
        // dd($product->photos);      // the product relation and it's attributes
        // dd($product->user);        // the user relation and it's attributes, and the pivot attributes (including comment)



        // To calculate Product Average Rate:
        // -u can do it usign Elqouent ORM (make a model for the Pivot table) and return it's attributes,
        // -u can do it usign Query Builder,
        // -u can calculate it manually (get the sum of all ratings and count them, then devide sum/count to calculate the average)

        // Using Query Builder
        // $productrating = DB::table('product_user')
        //                     ->selectRaw('AVG(rating) as average')
        //                     ->where('rating', '!=', 'Null')
        //                     ->where('product_id', $id)
        //                     ->get()
        //                     ->pluck('average')
        //                     ->first();

        // $productrating = ProductReview::withAvg('rating');
        // $productrating =round( ProductReview::where('product_id', $id)->average('rating'),  1);
        $productrating = round(ProductReview::where('product_id', $id)->avg('rating'), 1);



        // dd($productrating);

        // OR GET ALL THE RECORDS AND CHCCK -ON THE VIEW- WHO HAVE RATING AND WHO HAVE A COMMENT


        // $product->views = $product->views += 1;
        // $product->save();
        $product->update(['views' => $product->views + 1]);
        // $product->increment('views');

        return view('website.product', compact(['product', 'productrating', 'is_rated_previously']));
    }

    public function search()
    {

        /* YOU HAVE 3 CASES IN SEARCHIN:
        FIRST CASE: USER SEARCH USING KEYWORD
        SECOND CASE: USER SEARCH USING CATEGORY NAME
        THIRD CASE: USER SEARCH USING KEYWORD & CATEGORY NAME
        */
        $keyword = request()->keyword;
        $category_id = request()->category_id;

        // THIS IS A TIPYCALL SEARCH, IT'S NOT EFFECTIVE....
        // $products = product::where('name', '=', $keyword)
        //                     ->orWhere('description', '=', $keyword)
        //                     ->get();

        // THIS IS ALSO A TIPYCALL SEARCH, IT'S NOT EFFECTIVE.... YOU SHOULD ADD PLACEHOLDERS
        // $products = product::where('name', 'LIKE', $keyword)
        //                     ->orWhere('description', 'LIKE', $keyword)
        //                     ->get();

        // PLACEHOLDERS:
        //                _ ----> one character
        //                % ----> one or more characters

        // $products = product::where('name', 'LIKE', '_'.$keyword.'___') // one char before it, and three chars after it
        //                     ->orWhere('description', 'LIKE', '_'.$keyword.'_')
        //                     ->get();

        // $products = Product::query()->dd();

        $products = product::query(); // equal SELECT * FROM PRODUCT
        if($keyword) {
            $prodcuts = $products->where(function ($q) use ($keyword) {
                // THIS IS A COMPOUND WHERE, ONE WHERE CONTAINS MULTIPLE CASES
                return $q->where('name', 'LIKE', "%$keyword%")
                            ->orWhere('description', 'LIKE', "%$keyword%")
                            ->orWhere('sku', '=', "$keyword")
                            ->orWhere('price', '=', "$keyword");
            });
        }
        if($category_id) {
            $products = $products->where('category_id', $category_id);
        }
        $products = $products->get();

        return view('website.search_results', compact('products'));
        // redirect('website.search_results')->withInputs('keyword');
    }

    public function review()
    {
        auth()->user()->product()->attach(
            // user id will be send automatically
            ['product_id' => request()->product_id],          // product id
            request()->only('rating', 'comment')            // array that includes other pivots
            // ['rating'=> request()->rating,
            // 'comment'=> request()->comment]
        );

        return back()->with('success', 'Thanks for your review');
    }
}
