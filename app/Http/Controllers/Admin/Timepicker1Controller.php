<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Timepicker1;
use App\Http\Requests\CreateTimepicker1Request;
use App\Http\Requests\UpdateTimepicker1Request;
use Illuminate\Http\Request;



class Timepicker1Controller extends Controller {

	/**
	 * Display a listing of timepicker1
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $timepicker1 = Timepicker1::all();

		return view('admin.timepicker1.index', compact('timepicker1'));
	}

	/**
	 * Show the form for creating a new timepicker1
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.timepicker1.create');
	}

	/**
	 * Store a newly created timepicker1 in storage.
	 *
     * @param CreateTimepicker1Request|Request $request
	 */
	public function store(CreateTimepicker1Request $request)
	{
	    
		Timepicker1::create($request->all());

		return redirect()->route(config('quickadmin.route').'.timepicker1.index');
	}

	/**
	 * Show the form for editing the specified timepicker1.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$timepicker1 = Timepicker1::find(decrypt($id));
	    
	    
		return view('admin.timepicker1.edit', compact('timepicker1'));
	}

	/**
	 * Update the specified timepicker1 in storage.
     * @param UpdateTimepicker1Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateTimepicker1Request $request)
	{
		$timepicker1 = Timepicker1::findOrFail(decrypt($id));

        

		$timepicker1->update($request->all());

		return redirect()->route(config('quickadmin.route').'.timepicker1.index');
	}

	/**
	 * Remove the specified timepicker1 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Timepicker1::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.timepicker1.index');
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
            Timepicker1::destroy($toDelete);
        } else {
            Timepicker1::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.timepicker1.index');
    }

}
