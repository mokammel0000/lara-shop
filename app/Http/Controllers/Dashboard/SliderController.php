<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\Slide;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        // $slides = Slide::with('product')->get();
        $slides = Slide::with('product')->paginate(10);
        // TO DEFINE THIS RELATION, YOU SHOULD FIRSTLY DEFINE
        // THE PRODUCT RELATION IN THE SLIDER CLASS

        return view('dashboard.slider.index', compact('slides'));
    }

    public function create()
    {
        $products = product::get();
        return view('dashboard.slider.create', compact('products'));
    }

    public function store(Request $request)
    {
        $fileName =  now()->timestamp . '_' . $request->file('photo')->getClientOriginalName();
        $filePath =  'uploads/' . $fileName;
        $request->file('photo')->move('uploads', $fileName);

        $inputs = request()->all();
        $inputs['photo'] = $filePath;

        $newSlide = Slide::create($inputs);

        // return back()->with('success', 'The New Slide has been saved succesfully');
        return redirect('/admin/slides')->with('success', 'The New Slide has been saved succesfully');
    }

    public function show(string $id)
    {
        $slide = Slide::find($id);
        return view('dashboard.slider.show', compact('slide'));
    }

    public function edit(Slide $slide)
    {
        return view('dashboard.slider.edit', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        $request->validate([
            'content' => 'required',
            'product_id' => 'required'
        ]);


        if($request->hasFile('photo')) {
            $fileName =  now()->timestamp . '_' . $request->file('photo')->getClientOriginalName();
            $filePath =  'uploads/' . $fileName;

            $request->file('photo')->move('uploads', $fileName);
        }

        $inputs = $request->all();
        if($request->hasFile('photo')) {
            $inputs['photo'] = $filePath;

        }
        $slide->update($inputs);

        return back()->with('uploaded', 'The Slide has been Uploaded succesfully');


    }

    public function destroy(string $id)
    {
        $slider = Slide::find($id);
        Slide::destroy($id);

        //return back()->with('deleted', 'The Slider has been deleted succesfully');
        return redirect('/admin/slides')->with('deleted', 'The Slider has been deleted succesfully');

    }



    public function activate(string $id)
    {
        $slider = Slide::find($id);

        // $slider->active = 1;
        // $slider->save();

        // $inputs = [
        //     'active' => '1'
        // ];
        // $slider->update($inputs);

        $slider->update([
            'active' => '1',
        ]);

        return back();
    }

    public function deactivate(string $id)
    {
        $slider = Slide::find($id);

        // $slider->active = 0;
        // $slider->save();

        // $inputs = [
        //     'active' => '0'
        // ];
        // $slider->update($inputs);

        $slider->update([
            'active' => '0',
        ]);

        return back();
    }

    public function toggleActive(string $id)
    {
        $slider = Slide::find($id);
        // $slider->active = !$slider->active;
        // $slider->save();

        $slider->update([
            'active' => !$slider->active,
        ]);

        return back();
    }


}
