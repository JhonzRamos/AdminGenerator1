<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\ExampleMenu;
use App\Http\Requests\CreateExampleMenuRequest;
use App\Http\Requests\UpdateExampleMenuRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;


class ExampleMenuController extends Controller {

	/**
	 * Display a listing of examplemenu
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $examplemenu = ExampleMenu::all();

		return view('admin.examplemenu.index', compact('examplemenu'));
	}

	/**
	 * Show the form for creating a new examplemenu
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
        $oEnum = ExampleMenu::$oEnum;

	    return view('admin.examplemenu.create', compact("oEnum"));
	}

	/**
	 * Store a newly created examplemenu in storage.
	 *
     * @param CreateExampleMenuRequest|Request $request
	 */
	public function store(CreateExampleMenuRequest $request)
	{
	    $request = $this->saveFiles($request);
		ExampleMenu::create($request->all());

		return redirect()->route(config('quickadmin.route').'.examplemenu.index');
	}

	/**
	 * Show the form for editing the specified examplemenu.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$examplemenu = ExampleMenu::find(decrypt($id));
	    
	    
        $oEnum = ExampleMenu::$oEnum;

		return view('admin.examplemenu.edit', compact('examplemenu', "oEnum"));
	}

	/**
	 * Update the specified examplemenu in storage.
     * @param UpdateExampleMenuRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateExampleMenuRequest $request)
	{
		$examplemenu = ExampleMenu::findOrFail(decrypt($id));

        $request = $this->saveFiles($request);

		$examplemenu->update($request->all());

		return redirect()->route(config('quickadmin.route').'.examplemenu.index');
	}

	/**
	 * Remove the specified examplemenu from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		ExampleMenu::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.examplemenu.index');
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
            ExampleMenu::destroy($toDelete);
        } else {
            ExampleMenu::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.examplemenu.index');
    }

}
