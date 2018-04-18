<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Timepicker;
use App\Http\Requests\CreateTimepickerRequest;
use App\Http\Requests\UpdateTimepickerRequest;
use Illuminate\Http\Request;



class TimepickerController extends Controller {

	/**
	 * Display a listing of timepicker
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $timepicker = Timepicker::all();

		return view('admin.timepicker.index', compact('timepicker'));
	}

	/**
	 * Show the form for creating a new timepicker
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.timepicker.create');
	}

	/**
	 * Store a newly created timepicker in storage.
	 *
     * @param CreateTimepickerRequest|Request $request
	 */
	public function store(CreateTimepickerRequest $request)
	{
	    
		Timepicker::create($request->all());

		return redirect()->route(config('quickadmin.route').'.timepicker.index');
	}

	/**
	 * Show the form for editing the specified timepicker.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$timepicker = Timepicker::find(decrypt($id));
	    
	    
		return view('admin.timepicker.edit', compact('timepicker'));
	}

	/**
	 * Update the specified timepicker in storage.
     * @param UpdateTimepickerRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateTimepickerRequest $request)
	{
		$timepicker = Timepicker::findOrFail(decrypt($id));

        

		$timepicker->update($request->all());

		return redirect()->route(config('quickadmin.route').'.timepicker.index');
	}

	/**
	 * Remove the specified timepicker from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Timepicker::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.timepicker.index');
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
            Timepicker::destroy($toDelete);
        } else {
            Timepicker::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.timepicker.index');
    }

}
