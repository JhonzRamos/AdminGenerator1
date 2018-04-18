<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\EncryptedRoutes;
use App\Http\Requests\CreateEncryptedRoutesRequest;
use App\Http\Requests\UpdateEncryptedRoutesRequest;
use Illuminate\Http\Request;



class EncryptedRoutesController extends Controller {

	/**
	 * Display a listing of encryptedroutes
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $encryptedroutes = EncryptedRoutes::all();

		return view('admin.encryptedroutes.index', compact('encryptedroutes'));
	}

	/**
	 * Show the form for creating a new encryptedroutes
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.encryptedroutes.create');
	}

	/**
	 * Store a newly created encryptedroutes in storage.
	 *
     * @param CreateEncryptedRoutesRequest|Request $request
	 */
	public function store(CreateEncryptedRoutesRequest $request)
	{
	    
		EncryptedRoutes::create($request->all());

		return redirect()->route(config('quickadmin.route').'.encryptedroutes.index');
	}

	/**
	 * Show the form for editing the specified encryptedroutes.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$encryptedroutes = EncryptedRoutes::find(decrypt($id));
	    
	    
		return view('admin.encryptedroutes.edit', compact('encryptedroutes'));
	}

	/**
	 * Update the specified encryptedroutes in storage.
     * @param UpdateEncryptedRoutesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateEncryptedRoutesRequest $request)
	{
		$encryptedroutes = EncryptedRoutes::findOrFail(decrypt($id));

        

		$encryptedroutes->update($request->all());

		return redirect()->route(config('quickadmin.route').'.encryptedroutes.index');
	}

	/**
	 * Remove the specified encryptedroutes from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		EncryptedRoutes::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.encryptedroutes.index');
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

            EncryptedRoutes::destroy($toDelete);
        } else {
            EncryptedRoutes::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.encryptedroutes.index');
    }

}
