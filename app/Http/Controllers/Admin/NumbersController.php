<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Numbers;
use App\Http\Requests\CreateNumbersRequest;
use App\Http\Requests\UpdateNumbersRequest;
use Illuminate\Http\Request;



class NumbersController extends Controller {

	/**
	 * Display a listing of numbers
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $numbers = Numbers::all();

		return view('admin.numbers.index', compact('numbers'));
	}

	/**
	 * Show the form for creating a new numbers
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.numbers.create');
	}

	/**
	 * Store a newly created numbers in storage.
	 *
     * @param CreateNumbersRequest|Request $request
	 */
	public function store(CreateNumbersRequest $request)
	{
	    
		Numbers::create($request->all());

		return redirect()->route(config('quickadmin.route').'.numbers.index');
	}

	/**
	 * Show the form for editing the specified numbers.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$numbers = Numbers::find($id);
	    
	    
		return view('admin.numbers.edit', compact('numbers'));
	}

	/**
	 * Update the specified numbers in storage.
     * @param UpdateNumbersRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateNumbersRequest $request)
	{
		$numbers = Numbers::findOrFail($id);

        

		$numbers->update($request->all());

		return redirect()->route(config('quickadmin.route').'.numbers.index');
	}

	/**
	 * Remove the specified numbers from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Numbers::destroy($id);

		return redirect()->route(config('quickadmin.route').'.numbers.index');
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
            Numbers::destroy($toDelete);
        } else {
            Numbers::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.numbers.index');
    }

}
