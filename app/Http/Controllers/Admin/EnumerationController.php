<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Enumeration;
use App\Http\Requests\CreateEnumerationRequest;
use App\Http\Requests\UpdateEnumerationRequest;
use Illuminate\Http\Request;



class EnumerationController extends Controller {

	/**
	 * Display a listing of enumeration
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $enumeration = Enumeration::all();

		return view('admin.enumeration.index', compact('enumeration'));
	}

	/**
	 * Show the form for creating a new enumeration
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
        $sEnum = Enumeration::$sEnum;

	    return view('admin.enumeration.create', compact("sEnum"));
	}

	/**
	 * Store a newly created enumeration in storage.
	 *
     * @param CreateEnumerationRequest|Request $request
	 */
	public function store(CreateEnumerationRequest $request)
	{
	    
		Enumeration::create($request->all());

		return redirect()->route(config('quickadmin.route').'.enumeration.index');
	}

	/**
	 * Show the form for editing the specified enumeration.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$enumeration = Enumeration::find(decrypt($id));
	    
	    
        $sEnum = Enumeration::$sEnum;

		return view('admin.enumeration.edit', compact('enumeration', "sEnum"));
	}

	/**
	 * Update the specified enumeration in storage.
     * @param UpdateEnumerationRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateEnumerationRequest $request)
	{
		$enumeration = Enumeration::findOrFail(decrypt($id));

        

		$enumeration->update($request->all());

		return redirect()->route(config('quickadmin.route').'.enumeration.index');
	}

	/**
	 * Remove the specified enumeration from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Enumeration::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.enumeration.index');
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
            Enumeration::destroy($toDelete);
        } else {
            Enumeration::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.enumeration.index');
    }

}
