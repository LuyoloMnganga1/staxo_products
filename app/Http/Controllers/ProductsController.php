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
    public function index(): Response
    {
        if ($request->ajax()) {

            $data = Products::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()

                //**************IMAGE COLUMN**********//
                ->addColumn('image', function ($row) {

                    $image= $row->image;
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
                    <a href="view_product/' . $row->id . '" type="button" class="btn btn-sm btn-info text-light">View</a>';
                    // if(Auth::user()){
                    //  $action = $action.'
                    //  <a href="add_product" type="button" class="btn btn-sm btn-warning text-success">Add</a>
                    //  <a href="edit_product/' . $row->id . '" type="button" class="btn btn-sm btn-warning text-light">Edit</a>
                    //  <a href="delete_product/' . $row->id . '" type="button" id="delete_btn" class="btn btn-sm btn-danger text-light">Delete</a>';
                    // }
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
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products): Response
    {
        //
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
    public function destroy(Products $products): RedirectResponse
    {
        //
    }
}
