<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Sample;
use App\Http\Requests\CreateSampleRequest;
use App\Http\Requests\UpdateSampleRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class SampleController extends Controller {

	/**
	 * Display a listing of sample
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $sample = Sample::all();

		return view('admin.sample.index', compact('sample'));
	}

	/**
	 * Show the form for creating a new sample
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.sample.create');
	}

	/**
	 * Store a newly created sample in storage.
	 *
     * @param CreateSampleRequest|Request $request
	 */
	public function store(CreateSampleRequest $request)
	{
	    $request = $this->saveFiles($request);
		Sample::create($request->all());

		return redirect()->route(config('quickadmin.route').'.sample.index');
	}

	/**
	 * Show the form for editing the specified sample.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$sample = Sample::find(decrypt($id));
	    
	    
		return view('admin.sample.edit', compact('sample'));
	}

	/**
	 * Update the specified sample in storage.
     * @param UpdateSampleRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateSampleRequest $request)
	{
		$sample = Sample::findOrFail(decrypt($id));

        $request = $this->saveFiles($request);

		$sample->update($request->all());

		return redirect()->route(config('quickadmin.route').'.sample.index');
	}

	/**
	 * Remove the specified sample from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Sample::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.sample.index');
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
            Sample::destroy($toDelete);
        } else {
            Sample::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.sample.index');
    }

}
