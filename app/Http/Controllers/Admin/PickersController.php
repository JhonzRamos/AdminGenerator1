<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Pickers;
use App\Http\Requests\CreatePickersRequest;
use App\Http\Requests\UpdatePickersRequest;
use Illuminate\Http\Request;



class PickersController extends Controller {

	/**
	 * Display a listing of pickers
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $pickers = Pickers::all();

		return view('admin.pickers.index', compact('pickers'));
	}

	/**
	 * Show the form for creating a new pickers
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.pickers.create');
	}

	/**
	 * Store a newly created pickers in storage.
	 *
     * @param CreatePickersRequest|Request $request
	 */
	public function store(CreatePickersRequest $request)
	{
	    
		Pickers::create($request->all());

		return redirect()->route(config('quickadmin.route').'.pickers.index');
	}

	/**
	 * Show the form for editing the specified pickers.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$pickers = Pickers::find(decrypt($id));
	    
	    
		return view('admin.pickers.edit', compact('pickers'));
	}

	/**
	 * Update the specified pickers in storage.
     * @param UpdatePickersRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePickersRequest $request)
	{
		$pickers = Pickers::findOrFail(decrypt($id));

        

		$pickers->update($request->all());

		return redirect()->route(config('quickadmin.route').'.pickers.index');
	}

	/**
	 * Remove the specified pickers from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Pickers::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.pickers.index');
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
            Pickers::destroy($toDelete);
        } else {
            Pickers::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.pickers.index');
    }

}
