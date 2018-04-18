<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Examples;
use App\Http\Requests\CreateExamplesRequest;
use App\Http\Requests\UpdateExamplesRequest;
use Illuminate\Http\Request;



class ExamplesController extends Controller {

	/**
	 * Display a listing of examples
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $examples = Examples::all();

		return view('admin.examples.index', compact('examples'));
	}

	/**
	 * Show the form for creating a new examples
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.examples.create');
	}

	/**
	 * Store a newly created examples in storage.
	 *
     * @param CreateExamplesRequest|Request $request
	 */
	public function store(CreateExamplesRequest $request)
	{
	    
		Examples::create($request->all());

		return redirect()->route(config('quickadmin.route').'.examples.index');
	}

	/**
	 * Show the form for editing the specified examples.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$examples = Examples::find($id);
	    
	    
		return view('admin.examples.edit', compact('examples'));
	}

	/**
	 * Update the specified examples in storage.
     * @param UpdateExamplesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateExamplesRequest $request)
	{
		$examples = Examples::findOrFail($id);

        

		$examples->update($request->all());

		return redirect()->route(config('quickadmin.route').'.examples.index');
	}

	/**
	 * Remove the specified examples from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Examples::destroy($id);

		return redirect()->route(config('quickadmin.route').'.examples.index');
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
            Examples::destroy($toDelete);
        } else {
            Examples::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.examples.index');
    }

}
