<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Color;
use App\Http\Requests\CreateColorRequest;
use App\Http\Requests\UpdateColorRequest;
use Illuminate\Http\Request;



class ColorController extends Controller {

	/**
	 * Display a listing of color
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $color = Color::all();

		return view('admin.color.index', compact('color'));
	}

	/**
	 * Show the form for creating a new color
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.color.create');
	}

	/**
	 * Store a newly created color in storage.
	 *
     * @param CreateColorRequest|Request $request
	 */
	public function store(CreateColorRequest $request)
	{
	    
		Color::create($request->all());

		return redirect()->route(config('quickadmin.route').'.color.index');
	}

	/**
	 * Show the form for editing the specified color.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$color = Color::find(decrypt($id));
	    
	    
		return view('admin.color.edit', compact('color'));
	}

	/**
	 * Update the specified color in storage.
     * @param UpdateColorRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateColorRequest $request)
	{
		$color = Color::findOrFail(decrypt($id));

        

		$color->update($request->all());

		return redirect()->route(config('quickadmin.route').'.color.index');
	}

	/**
	 * Remove the specified color from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Color::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.color.index');
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
            Color::destroy($toDelete);
        } else {
            Color::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.color.index');
    }

}
