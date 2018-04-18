<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Products;
use App\Http\Requests\CreateProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use Illuminate\Http\Request;



class ProductsController extends Controller {

	/**
	 * Display a listing of products
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $products = Products::all();

		return view('admin.products.index', compact('products'));
	}

	/**
	 * Show the form for creating a new products
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.products.create');
	}

	/**
	 * Store a newly created products in storage.
	 *
     * @param CreateProductsRequest|Request $request
	 */
	public function store(CreateProductsRequest $request)
	{
	    
		Products::create($request->all());

		return redirect()->route(config('quickadmin.route').'.products.index');
	}

	/**
	 * Show the form for editing the specified products.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$products = Products::find($id);
	    
	    
		return view('admin.products.edit', compact('products'));
	}

	/**
	 * Update the specified products in storage.
     * @param UpdateProductsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateProductsRequest $request)
	{
		$products = Products::findOrFail($id);

        

		$products->update($request->all());

		return redirect()->route(config('quickadmin.route').'.products.index');
	}

	/**
	 * Remove the specified products from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Products::destroy($id);

		return redirect()->route(config('quickadmin.route').'.products.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Products::destroy($toDelete);
        } else {
            Products::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.products.index');
    }

}
