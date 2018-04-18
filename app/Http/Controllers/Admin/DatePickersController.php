<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\DatePickers;
use App\Http\Requests\CreateDatePickersRequest;
use App\Http\Requests\UpdateDatePickersRequest;
use Illuminate\Http\Request;



class DatePickersController extends Controller {

	/**
	 * Display a listing of datepickers
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $datepickers = DatePickers::all();

		return view('admin.datepickers.index', compact('datepickers'));
	}

	/**
	 * Show the form for creating a new datepickers
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.datepickers.create');
	}

	/**
	 * Store a newly created datepickers in storage.
	 *
     * @param CreateDatePickersRequest|Request $request
	 */
	public function store(CreateDatePickersRequest $request)
	{
	    
		DatePickers::create($request->all());

		return redirect()->route(config('quickadmin.route').'.datepickers.index');
	}

	/**
	 * Show the form for editing the specified datepickers.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$datepickers = DatePickers::find(decrypt($id));
	    
	    
		return view('admin.datepickers.edit', compact('datepickers'));
	}

	/**
	 * Update the specified datepickers in storage.
     * @param UpdateDatePickersRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateDatePickersRequest $request)
	{
		$datepickers = DatePickers::findOrFail(decrypt($id));

        

		$datepickers->update($request->all());

		return redirect()->route(config('quickadmin.route').'.datepickers.index');
	}

	/**
	 * Remove the specified datepickers from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		DatePickers::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.datepickers.index');
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
            DatePickers::destroy($toDelete);
        } else {
            DatePickers::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.datepickers.index');
    }

}
