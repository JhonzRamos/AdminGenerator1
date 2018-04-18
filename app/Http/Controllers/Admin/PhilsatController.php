<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Philsat;
use App\Http\Requests\CreatePhilsatRequest;
use App\Http\Requests\UpdatePhilsatRequest;
use Illuminate\Http\Request;



class PhilsatController extends Controller {

	/**
	 * Display a listing of philsat
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $philsat = Philsat::all();

		return view('admin.philsat.index', compact('philsat'));
	}

	/**
	 * Show the form for creating a new philsat
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.philsat.create');
	}

	/**
	 * Store a newly created philsat in storage.
	 *
     * @param CreatePhilsatRequest|Request $request
	 */
	public function store(CreatePhilsatRequest $request)
	{
	    
		Philsat::create($request->all());

		return redirect()->route(config('quickadmin.route').'.philsat.index');
	}

	/**
	 * Show the form for editing the specified philsat.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$philsat = Philsat::find($id);
	    
	    
		return view('admin.philsat.edit', compact('philsat'));
	}

	/**
	 * Update the specified philsat in storage.
     * @param UpdatePhilsatRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePhilsatRequest $request)
	{
		$philsat = Philsat::findOrFail($id);

        

		$philsat->update($request->all());

		return redirect()->route(config('quickadmin.route').'.philsat.index');
	}

	/**
	 * Remove the specified philsat from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Philsat::destroy($id);

		return redirect()->route(config('quickadmin.route').'.philsat.index');
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
            Philsat::destroy($toDelete);
        } else {
            Philsat::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.philsat.index');
    }

}
