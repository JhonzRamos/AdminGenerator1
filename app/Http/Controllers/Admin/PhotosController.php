<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Photos;
use App\Http\Requests\CreatePhotosRequest;
use App\Http\Requests\UpdatePhotosRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class PhotosController extends Controller {

	/**
	 * Display a listing of photos
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $photos = Photos::all();

		return view('admin.photos.index', compact('photos'));
	}

	/**
	 * Show the form for creating a new photos
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.photos.create');
	}

	/**
	 * Store a newly created photos in storage.
	 *
     * @param CreatePhotosRequest|Request $request
	 */
	public function store(CreatePhotosRequest $request)
	{
	    $request = $this->saveFiles($request);
		Photos::create($request->all());

		return redirect()->route(config('quickadmin.route').'.photos.index');
	}

	/**
	 * Show the form for editing the specified photos.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$photos = Photos::find(decrypt($id));
	    
	    
		return view('admin.photos.edit', compact('photos'));
	}

	/**
	 * Update the specified photos in storage.
     * @param UpdatePhotosRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdatePhotosRequest $request)
	{
		$photos = Photos::findOrFail(decrypt($id));

        $request = $this->saveFiles($request);

		$photos->update($request->all());

		return redirect()->route(config('quickadmin.route').'.photos.index');
	}

	/**
	 * Remove the specified photos from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Photos::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.photos.index');
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
            Photos::destroy($toDelete);
        } else {
            Photos::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.photos.index');
    }

}
