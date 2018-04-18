<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Fileuploading;
use App\Http\Requests\CreateFileuploadingRequest;
use App\Http\Requests\UpdateFileuploadingRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class FileuploadingController extends Controller {

	/**
	 * Display a listing of fileuploading
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $fileuploading = Fileuploading::all();

		return view('admin.fileuploading.index', compact('fileuploading'));
	}

	/**
	 * Show the form for creating a new fileuploading
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.fileuploading.create');
	}

	/**
	 * Store a newly created fileuploading in storage.
	 *
     * @param CreateFileuploadingRequest|Request $request
	 */
	public function store(CreateFileuploadingRequest $request)
	{
	    $request = $this->saveFiles($request);
		Fileuploading::create($request->all());

		return redirect()->route(config('quickadmin.route').'.fileuploading.index');
	}

	/**
	 * Show the form for editing the specified fileuploading.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$fileuploading = Fileuploading::find($id);
	    
	    
		return view('admin.fileuploading.edit', compact('fileuploading'));
	}

	/**
	 * Update the specified fileuploading in storage.
     * @param UpdateFileuploadingRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFileuploadingRequest $request)
	{
		$fileuploading = Fileuploading::findOrFail($id);

        $request = $this->saveFiles($request);

		$fileuploading->update($request->all());

		return redirect()->route(config('quickadmin.route').'.fileuploading.index');
	}

	/**
	 * Remove the specified fileuploading from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Fileuploading::destroy($id);

		return redirect()->route(config('quickadmin.route').'.fileuploading.index');
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
            Fileuploading::destroy($toDelete);
        } else {
            Fileuploading::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.fileuploading.index');
    }

}
