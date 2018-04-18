<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Many2;
use App\Http\Requests\CreateMany2Request;
use App\Http\Requests\UpdateMany2Request;
use Illuminate\Http\Request;



class Many2Controller extends Controller {

	/**
	 * Display a listing of many2
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $many2 = Many2::all();

		return view('admin.many2.index', compact('many2'));
	}

	/**
	 * Show the form for creating a new many2
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.many2.create');
	}

	/**
	 * Store a newly created many2 in storage.
	 *
     * @param CreateMany2Request|Request $request
	 */
	public function store(CreateMany2Request $request)
	{
	    
		Many2::create($request->all());

		return redirect()->route(config('quickadmin.route').'.many2.index');
	}

	/**
	 * Show the form for editing the specified many2.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$many2 = Many2::find(decrypt($id));
	    
	    
		return view('admin.many2.edit', compact('many2'));
	}

	/**
	 * Update the specified many2 in storage.
     * @param UpdateMany2Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateMany2Request $request)
	{
		$many2 = Many2::findOrFail(decrypt($id));

        

		$many2->update($request->all());

		return redirect()->route(config('quickadmin.route').'.many2.index');
	}

	/**
	 * Remove the specified many2 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Many2::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.many2.index');
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
            Many2::destroy($toDelete);
        } else {
            Many2::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.many2.index');
    }

}
