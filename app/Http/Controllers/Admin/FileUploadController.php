<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\FileUpload;
use App\Http\Requests\CreateFileUploadRequest;
use App\Http\Requests\UpdateFileUploadRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class FileUploadController extends Controller {

	/**
	 * Display a listing of fileupload
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $fileupload = FileUpload::all();

		return view('admin.fileupload.index', compact('fileupload'));
	}

	/**
	 * Show the form for creating a new fileupload
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.fileupload.create');
	}

	/**
	 * Store a newly created fileupload in storage.
	 *
     * @param CreateFileUploadRequest|Request $request
	 */
	public function store(CreateFileUploadRequest $request)
	{
	    $request = $this->saveFiles($request);
		FileUpload::create($request->all());

		return redirect()->route(config('quickadmin.route').'.fileupload.index');
	}

	/**
	 * Show the form for editing the specified fileupload.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$fileupload = FileUpload::find($id);
	    
	    
		return view('admin.fileupload.edit', compact('fileupload'));
	}

	/**
	 * Update the specified fileupload in storage.
     * @param UpdateFileUploadRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFileUploadRequest $request)
	{
		$fileupload = FileUpload::findOrFail($id);

        $request = $this->saveFiles($request);

		$fileupload->update($request->all());

		return redirect()->route(config('quickadmin.route').'.fileupload.index');
	}

	/**
	 * Remove the specified fileupload from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		FileUpload::destroy($id);

		return redirect()->route(config('quickadmin.route').'.fileupload.index');
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
            FileUpload::destroy($toDelete);
        } else {
            FileUpload::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.fileupload.index');
    }

}
