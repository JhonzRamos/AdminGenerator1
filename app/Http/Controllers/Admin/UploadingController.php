<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Uploading;
use App\Http\Requests\CreateUploadingRequest;
use App\Http\Requests\UpdateUploadingRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class UploadingController extends Controller {

	/**
	 * Display a listing of uploading
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $uploading = Uploading::all();

		return view('admin.uploading.index', compact('uploading'));
	}

	/**
	 * Show the form for creating a new uploading
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.uploading.create');
	}

	/**
	 * Store a newly created uploading in storage.
	 *
     * @param CreateUploadingRequest|Request $request
	 */
	public function store(CreateUploadingRequest $request)
	{
	    $request = $this->saveFiles($request);
		Uploading::create($request->all());

		return redirect()->route(config('quickadmin.route').'.uploading.index');
	}

	/**
	 * Show the form for editing the specified uploading.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$uploading = Uploading::find($id);
	    
	    
		return view('admin.uploading.edit', compact('uploading'));
	}

	/**
	 * Update the specified uploading in storage.
     * @param UpdateUploadingRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateUploadingRequest $request)
	{
		$uploading = Uploading::findOrFail($id);

        $request = $this->saveFiles($request);

		$uploading->update($request->all());

		return redirect()->route(config('quickadmin.route').'.uploading.index');
	}

	/**
	 * Remove the specified uploading from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Uploading::destroy($id);

		return redirect()->route(config('quickadmin.route').'.uploading.index');
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
            Uploading::destroy($toDelete);
        } else {
            Uploading::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.uploading.index');
    }

}
