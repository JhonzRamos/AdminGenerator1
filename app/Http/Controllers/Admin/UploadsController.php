<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Uploads;
use App\Http\Requests\CreateUploadsRequest;
use App\Http\Requests\UpdateUploadsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class UploadsController extends Controller {

	/**
	 * Display a listing of uploads
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $uploads = Uploads::all();

		return view('admin.uploads.index', compact('uploads'));
	}

	/**
	 * Show the form for creating a new uploads
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.uploads.create');
	}

	/**
	 * Store a newly created uploads in storage.
	 *
     * @param CreateUploadsRequest|Request $request
	 */
	public function store(CreateUploadsRequest $request)
	{
	    $request = $this->saveFiles($request);
		Uploads::create($request->all());

		return redirect()->route(config('quickadmin.route').'.uploads.index');
	}

	/**
	 * Show the form for editing the specified uploads.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$uploads = Uploads::find($id);
	    
	    
		return view('admin.uploads.edit', compact('uploads'));
	}

	/**
	 * Update the specified uploads in storage.
     * @param UpdateUploadsRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateUploadsRequest $request)
	{
		$uploads = Uploads::findOrFail($id);

        $request = $this->saveFiles($request);

		$uploads->update($request->all());

		return redirect()->route(config('quickadmin.route').'.uploads.index');
	}

	/**
	 * Remove the specified uploads from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Uploads::destroy($id);

		return redirect()->route(config('quickadmin.route').'.uploads.index');
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
            Uploads::destroy($toDelete);
        } else {
            Uploads::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.uploads.index');
    }

}
