<?php

namespace App\Http\Controllers;


use App\Category;
use App\Food;
use App\Http\Requests\FoodRequest;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $food= Food::latest()->paginate(3);
        return view('food.all',compact('food'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FoodRequest $request)
    {
        //----------Image preparation for uploading and storing
        $image =$request->file('image');
        $image_name = time().'.'.$image->getClientOriginalExtension();
        $image_path=public_path('/images/food');
        $image->move($image_path,$image_name );

        //------------------------------------------------------------
        Food::create([
            "image"=>$image_name,
            "name"=>$request->input('name'),
            "description"=>$request->input('description'),
            "price"=>$request->input('price'),
            "category_id"=>$request->input('category'),

        ]);
        return redirect('food')->with(['success' => 'category has been added successfully ']);

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

        $food=Food::find($id);
        return view('food.edit' ,compact('food'));
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
        $request->validate([
            'image'=>'mimes:png,jpg,jpeg',
            'name' => 'required|max:100',
            'description' => 'required',
            'price' => 'required|numeric',
            'category'=>'required'
        ]);
        $food =Food::find($id);
        $image_name=$food->image;
        if($request->hasFile('image')){
            $image =$request->file('image');
            $image_name = time().'.'.$image->getClientOriginalExtension();
            $image_path=public_path('/images/food');
            $image->move($image_path,$image_name );
        }else{
            $image_name=$food->image;
        }
        $food->image =  $image_name ;
        $food->name = $request->get('name');
        $food->description= $request->get('description');
        $food->price = $request->get('price');
        $food->category_id = $request->get('category');
        //---2------$food->update(['name'=>$request->get('name'),.....
        $food->save();
        return redirect('food')->with(['success'=>'updated successfully']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $food= Food::find($id);
        $food->delete();
        return redirect()->back()->with(['success'=>'deleted successfully']);
    }
    public function listFood(){
        $categories= Category::with('food')->get();

        return view('food.list',compact('categories'));
    }
    public function view($id){
        $food = Food::find($id);
        return view('food.detail', compact('food'));
    }
}
