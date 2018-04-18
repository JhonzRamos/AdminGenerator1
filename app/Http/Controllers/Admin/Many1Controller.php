<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Many1;
use App\Http\Requests\CreateMany1Request;
use App\Http\Requests\UpdateMany1Request;
use Illuminate\Http\Request;



class Many1Controller extends Controller {

	/**
	 * Display a listing of many1
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $many1 = Many1::all();

		return view('admin.many1.index', compact('many1'));
	}

	/**
	 * Show the form for creating a new many1
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.many1.create');
	}

	/**
	 * Store a newly created many1 in storage.
	 *
     * @param CreateMany1Request|Request $request
	 */
	public function store(CreateMany1Request $request)
	{
	    
		Many1::create($request->all());

		return redirect()->route(config('quickadmin.route').'.many1.index');
	}

	/**
	 * Show the form for editing the specified many1.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$many1 = Many1::find(decrypt($id));
	    
	    
		return view('admin.many1.edit', compact('many1'));
	}

	/**
	 * Update the specified many1 in storage.
     * @param UpdateMany1Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateMany1Request $request)
	{
		$many1 = Many1::findOrFail(decrypt($id));

        

		$many1->update($request->all());

		return redirect()->route(config('quickadmin.route').'.many1.index');
	}

	/**
	 * Remove the specified many1 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Many1::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.many1.index');
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
            Many1::destroy($toDelete);
        } else {
            Many1::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.many1.index');
    }

}
