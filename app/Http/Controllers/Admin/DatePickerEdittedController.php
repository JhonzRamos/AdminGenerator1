<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\DatePickerEditted;
use App\Http\Requests\CreateDatePickerEdittedRequest;
use App\Http\Requests\UpdateDatePickerEdittedRequest;
use Illuminate\Http\Request;



class DatePickerEdittedController extends Controller {

	/**
	 * Display a listing of datepickereditted
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $datepickereditted = DatePickerEditted::all();

		return view('admin.datepickereditted.index', compact('datepickereditted'));
	}

	/**
	 * Show the form for creating a new datepickereditted
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.datepickereditted.create');
	}

	/**
	 * Store a newly created datepickereditted in storage.
	 *
     * @param CreateDatePickerEdittedRequest|Request $request
	 */
	public function store(CreateDatePickerEdittedRequest $request)
	{
	    
		DatePickerEditted::create($request->all());

		return redirect()->route(config('quickadmin.route').'.datepickereditted.index');
	}

	/**
	 * Show the form for editing the specified datepickereditted.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$datepickereditted = DatePickerEditted::find(decrypt($id));
	    
	    
		return view('admin.datepickereditted.edit', compact('datepickereditted'));
	}

	/**
	 * Update the specified datepickereditted in storage.
     * @param UpdateDatePickerEdittedRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateDatePickerEdittedRequest $request)
	{
		$datepickereditted = DatePickerEditted::findOrFail(decrypt($id));

        

		$datepickereditted->update($request->all());

		return redirect()->route(config('quickadmin.route').'.datepickereditted.index');
	}

	/**
	 * Remove the specified datepickereditted from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		DatePickerEditted::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.datepickereditted.index');
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
            DatePickerEditted::destroy($toDelete);
        } else {
            DatePickerEditted::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.datepickereditted.index');
    }

}
