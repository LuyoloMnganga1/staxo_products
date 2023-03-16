<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('welcome');
    }
    public function getproducts(Request $request)
    {
        if ($request->ajax()) {

            $data = Products::latest()->get();

            return  $data = Datatables::of($data)
                ->addIndexColumn()

                //**************IMAGE COLUMN**********//
                ->addColumn('image', function ($row) {
                    if($row->image == "" || $row->image == "N/A"){ 
                        $image = '<img src="images/palceholder.png" alt="" style="width:30px;height:30px;" class="rounded-circle" alt="Avatar">';
                    }else{
                        $image = '<img src="'.$row->image.'" alt="" class="rounded-circle" style="width:30px;height:30px;" alt="Avatar">';
                    }
                    return $image;
                })
                //**********END IMAGE COLUMN*********//

                //**************NAME COLUMN**********//
                ->addColumn('name', function ($row) {

                   $name = $row->name;
                    return $name;
                })
                //**********END NAME COLUMN*********//


                //**************PRICE BY COLUMN**********//
                ->addColumn('price', function ($row) {
                        $price = 'R '.$row->price;                       
                    return $price;
                })
                //**********END PRICE BY COLUMN*********//


                //**************ACTION COLUMN**********//
                ->addColumn('action', function ($row) {
                    $action = '<div class="btn-group">
                    <a  type="button" class="btn btn-sm btn-info text-light" data-href="view_product/' . $row->id . '" id="view_btn" >View</a>';
                    if(Auth::user()){
                     $action = $action.'
                     <a data-href="view_product/' . $row->id . '" type="button" class="btn btn-sm btn-warning text-light" id="edit_btn">Edit</a>
                     <a data-href="delete_product/' . $row->id . '" type="button" id="delete_btn" class="btn btn-sm btn-danger text-light" id="delete_btn">Delete</a>';
                    }
                    $action = $action.'</div>';
                    return $action;
                })
                //**********END ACTION COLUMN*********// 

                ->rawColumns(['image', 'name', 'price', 'action'])
                ->make(true);
        }
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show(Request $request,$id)
    {
            $product = Products::find($id);
            return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $product = $request->validate([
            'image' => ['required',],
            'name' => ['required','string'],
            'price' => ['required'],
        ]);

        $path='';
        if($request->hasFile('image')){
            $img = auth()->id() . '_' . time() . '.'. $request->image->extension();
            $request->image->move('storage/app/images', $img);
            $path = 'storage/app/images/'.$img;
        }
        Products::create([
            'image' => $path,
            'name' => $product['name'],
            'price' => $product['price'],
        ]);

        return redirect()->back()->with('success','Product created successfully');
    }
    public function edit(Request $request)
    {
        $id = $request->product_id;
        $product = $request->validate([
            'image' => ['required',],
            'name' => ['required','string'],
            'price' => ['required'],
        ]);

        $path='';
        if($request->hasFile('image')){
            $img = auth()->id() . '_' . time() . '.'. $request->image->extension();
            $request->image->move('storage/app/images', $img);
            $path = 'storage/app/images/'.$img;
        }
        Products::where('id',$id)->update([
            'image' => $path,
            'name' => $product['name'],
            'price' => $product['price'],
        ]);

        return redirect()->back()->with('success','Product updated successfully');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Products::find($id)->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
