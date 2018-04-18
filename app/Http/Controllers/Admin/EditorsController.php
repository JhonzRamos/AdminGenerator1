<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Editors;
use App\Http\Requests\CreateEditorsRequest;
use App\Http\Requests\UpdateEditorsRequest;
use Illuminate\Http\Request;



class EditorsController extends Controller {

	/**
	 * Display a listing of editors
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $editors = Editors::all();

		return view('admin.editors.index', compact('editors'));
	}

	/**
	 * Show the form for creating a new editors
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.editors.create');
	}

	/**
	 * Store a newly created editors in storage.
	 *
     * @param CreateEditorsRequest|Request $request
	 */
	public function store(CreateEditorsRequest $request)
	{
	    
		Editors::create($request->all());

		return redirect()->route(config('quickadmin.route').'.editors.index');
	}

	/**
	 * Show the form for editing the specified editors.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$editors = Editors::find($id);
	    
	    
		return view('admin.editors.edit', compact('editors'));
	}

	/**
	 * Update the specified editors in storage.
     * @param UpdateEditorsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateEditorsRequest $request)
	{
		$editors = Editors::findOrFail($id);

        

		$editors->update($request->all());

		return redirect()->route(config('quickadmin.route').'.editors.index');
	}

	/**
	 * Remove the specified editors from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Editors::destroy($id);

		return redirect()->route(config('quickadmin.route').'.editors.index');
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
            Editors::destroy($toDelete);
        } else {
            Editors::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.editors.index');
    }

}
