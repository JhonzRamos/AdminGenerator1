<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\NewEnrypted;
use App\Http\Requests\CreateNewEnryptedRequest;
use App\Http\Requests\UpdateNewEnryptedRequest;
use Illuminate\Http\Request;



class NewEnryptedController extends Controller {

	/**
	 * Display a listing of newenrypted
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $newenrypted = NewEnrypted::all();

		return view('admin.newenrypted.index', compact('newenrypted'));
	}

	/**
	 * Show the form for creating a new newenrypted
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.newenrypted.create');
	}

	/**
	 * Store a newly created newenrypted in storage.
	 *
     * @param CreateNewEnryptedRequest|Request $request
	 */
	public function store(CreateNewEnryptedRequest $request)
	{
	    
		NewEnrypted::create($request->all());

		return redirect()->route(config('quickadmin.route').'.newenrypted.index');
	}

	/**
	 * Show the form for editing the specified newenrypted.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$newenrypted = NewEnrypted::find(decrypt($id));
	    
	    
		return view('admin.newenrypted.edit', compact('newenrypted'));
	}

	/**
	 * Update the specified newenrypted in storage.
     * @param UpdateNewEnryptedRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateNewEnryptedRequest $request)
	{
		$newenrypted = NewEnrypted::findOrFail(decrypt($id));

        

		$newenrypted->update($request->all());

		return redirect()->route(config('quickadmin.route').'.newenrypted.index');
	}

	/**
	 * Remove the specified newenrypted from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		NewEnrypted::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.newenrypted.index');
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
            NewEnrypted::destroy($toDelete);
        } else {
            NewEnrypted::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.newenrypted.index');
    }

}
