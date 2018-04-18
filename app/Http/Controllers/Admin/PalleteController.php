<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Pallete;
use App\Http\Requests\CreatePalleteRequest;
use App\Http\Requests\UpdatePalleteRequest;
use Illuminate\Http\Request;



class PalleteController extends Controller {

	/**
	 * Display a listing of pallete
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $pallete = Pallete::all();

		return view('admin.pallete.index', compact('pallete'));
	}

	/**
	 * Show the form for creating a new pallete
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.pallete.create');
	}

	/**
	 * Store a newly created pallete in storage.
	 *
     * @param CreatePalleteRequest|Request $request
	 */
	public function store(CreatePalleteRequest $request)
	{
	    
		Pallete::create($request->all());

		return redirect()->route(config('quickadmin.route').'.pallete.index');
	}

	/**
	 * Show the form for editing the specified pallete.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$pallete = Pallete::find(decrypt($id));
	    
	    
		return view('admin.pallete.edit', compact('pallete'));
	}

	/**
	 * Update the specified pallete in storage.
     * @param UpdatePalleteRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePalleteRequest $request)
	{
		$pallete = Pallete::findOrFail(decrypt($id));

        

		$pallete->update($request->all());

		return redirect()->route(config('quickadmin.route').'.pallete.index');
	}

	/**
	 * Remove the specified pallete from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Pallete::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.pallete.index');
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
            Pallete::destroy($toDelete);
        } else {
            Pallete::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.pallete.index');
    }

}
