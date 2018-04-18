<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\LocationTest1;
use App\Http\Requests\CreateLocationTest1Request;
use App\Http\Requests\UpdateLocationTest1Request;
use Illuminate\Http\Request;



class LocationTest1Controller extends Controller {

	/**
	 * Display a listing of locationtest1
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $locationtest1 = LocationTest1::all();

		return view('admin.locationtest1.index', compact('locationtest1'));
	}

	/**
	 * Show the form for creating a new locationtest1
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.locationtest1.create');
	}

	/**
	 * Store a newly created locationtest1 in storage.
	 *
     * @param CreateLocationTest1Request|Request $request
	 */
	public function store(CreateLocationTest1Request $request)
	{
	    
		LocationTest1::create($request->all());

		return redirect()->route(config('quickadmin.route').'.locationtest1.index');
	}

	/**
	 * Show the form for editing the specified locationtest1.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$locationtest1 = LocationTest1::find($id);
	    
	    
		return view('admin.locationtest1.edit', compact('locationtest1'));
	}

	/**
	 * Update the specified locationtest1 in storage.
     * @param UpdateLocationTest1Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateLocationTest1Request $request)
	{
		$locationtest1 = LocationTest1::findOrFail($id);

        

		$locationtest1->update($request->all());

		return redirect()->route(config('quickadmin.route').'.locationtest1.index');
	}

	/**
	 * Remove the specified locationtest1 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		LocationTest1::destroy($id);

		return redirect()->route(config('quickadmin.route').'.locationtest1.index');
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
            LocationTest1::destroy($toDelete);
        } else {
            LocationTest1::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.locationtest1.index');
    }

}
