<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\TableSorting;
use App\Http\Requests\CreateTableSortingRequest;
use App\Http\Requests\UpdateTableSortingRequest;
use Illuminate\Http\Request;



class TableSortingController extends Controller {

	/**
	 * Display a listing of tablesorting
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $tablesorting = TableSorting::all();

		return view('admin.tablesorting.index', compact('tablesorting'));
	}

	/**
	 * Show the form for creating a new tablesorting
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.tablesorting.create');
	}

	/**
	 * Store a newly created tablesorting in storage.
	 *
     * @param CreateTableSortingRequest|Request $request
	 */
	public function store(CreateTableSortingRequest $request)
	{
	    
		TableSorting::create($request->all());

		return redirect()->route(config('quickadmin.route').'.tablesorting.index');
	}

	/**
	 * Show the form for editing the specified tablesorting.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$tablesorting = TableSorting::find($id);
	    
	    
		return view('admin.tablesorting.edit', compact('tablesorting'));
	}

	/**
	 * Update the specified tablesorting in storage.
     * @param UpdateTableSortingRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateTableSortingRequest $request)
	{
		$tablesorting = TableSorting::findOrFail($id);

        

		$tablesorting->update($request->all());

		return redirect()->route(config('quickadmin.route').'.tablesorting.index');
	}

	/**
	 * Remove the specified tablesorting from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		TableSorting::destroy($id);

		return redirect()->route(config('quickadmin.route').'.tablesorting.index');
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
            TableSorting::destroy($toDelete);
        } else {
            TableSorting::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.tablesorting.index');
    }

}
