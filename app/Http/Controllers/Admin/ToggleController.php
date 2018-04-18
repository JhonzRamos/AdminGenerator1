<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Toggle;
use App\Http\Requests\CreateToggleRequest;
use App\Http\Requests\UpdateToggleRequest;
use Illuminate\Http\Request;



class ToggleController extends Controller {

	/**
	 * Display a listing of toggle
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $toggle = Toggle::all();

		return view('admin.toggle.index', compact('toggle'));
	}

	/**
	 * Show the form for creating a new toggle
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.toggle.create');
	}

	/**
	 * Store a newly created toggle in storage.
	 *
     * @param CreateToggleRequest|Request $request
	 */
	public function store(CreateToggleRequest $request)
	{
	    
		Toggle::create($request->all());

		return redirect()->route(config('quickadmin.route').'.toggle.index');
	}

	/**
	 * Show the form for editing the specified toggle.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$toggle = Toggle::find(decrypt($id));
	    
	    
		return view('admin.toggle.edit', compact('toggle'));
	}

	/**
	 * Update the specified toggle in storage.
     * @param UpdateToggleRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateToggleRequest $request)
	{
		$toggle = Toggle::findOrFail(decrypt($id));

        

		$toggle->update($request->all());

		return redirect()->route(config('quickadmin.route').'.toggle.index');
	}

	/**
	 * Remove the specified toggle from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Toggle::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.toggle.index');
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
            Toggle::destroy($toDelete);
        } else {
            Toggle::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.toggle.index');
    }

}
