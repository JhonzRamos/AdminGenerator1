<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Favorites1;
use App\Http\Requests\CreateFavorites1Request;
use App\Http\Requests\UpdateFavorites1Request;
use Illuminate\Http\Request;



class Favorites13Controller extends Controller {

	/**
	 * Display a listing of favorites1
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $favorites1 = Favorites1::all();

		return view('admin.favorites1.index', compact('favorites1'));
	}

	/**
	 * Show the form for creating a new favorites1
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.favorites1.create');
	}

	/**
	 * Store a newly created favorites1 in storage.
	 *
     * @param CreateFavorites1Request|Request $request
	 */
	public function store(CreateFavorites1Request $request)
	{
	    
		Favorites1::create($request->all());

		return redirect()->route(config('quickadmin.route').'.favorites1.index');
	}

	/**
	 * Show the form for editing the specified favorites1.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$favorites1 = Favorites1::find(decrypt($id));
	    
	    
		return view('admin.favorites1.edit', compact('favorites1'));
	}

	/**
	 * Update the specified favorites1 in storage.
     * @param UpdateFavorites1Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFavorites1Request $request)
	{
		$favorites1 = Favorites1::findOrFail(decrypt($id));

        

		$favorites1->update($request->all());

		return redirect()->route(config('quickadmin.route').'.favorites1.index');
	}

	/**
	 * Remove the specified favorites1 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Favorites1::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.favorites1.index');
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

            foreach($toDelete as $row){
            	$toDelete[$row] = decrypt($row);
            }
            Favorites1::destroy($toDelete);
        } else {
            Favorites1::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.favorites1.index');
    }

}
