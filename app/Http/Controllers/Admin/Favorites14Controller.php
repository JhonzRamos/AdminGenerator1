<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Favorites14;
use App\Http\Requests\CreateFavorites14Request;
use App\Http\Requests\UpdateFavorites14Request;
use Illuminate\Http\Request;

use App\Books;
use App\Favorites14Books;


class Favorites14Controller extends Controller {

	/**
	 * Display a listing of favorites14
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $favorites14 = Favorites14::get();

		return view('admin.favorites14.index', compact('favorites14'));
	}

	/**
	 * Show the form for creating a new favorites14
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
		$books = Books::pluck("sTitle", "id")->prepend('Please select', 0);


		return view('admin.favorites14.create', compact("books"));


	}

	/**
	 * Store a newly created favorites14 in storage.
	 *
     * @param CreateFavorites14Request|Request $request
	 */
	public function store(CreateFavorites14Request $request)
	{
	    

		$model = Favorites14::create($request->all());

		//save item
        for($i = 0; $i < sizeof($request->books_id); $i++){
        	Favorites14Books::create([ 'favorites14_id' => $model->id, 'books_id' =>intval($request->books_id[$i])]);
        }

		return redirect()->route(config('quickadmin.route').'.favorites14.index');
	}

	/**
	 * Show the form for editing the specified favorites14.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$favorites14 = Favorites14::find(decrypt($id));
	    
	    
		return view('admin.favorites14.edit', compact('favorites14'));
	}

	/**
	 * Update the specified favorites14 in storage.
     * @param UpdateFavorites14Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFavorites14Request $request)
	{
		$favorites14 = Favorites14::findOrFail(decrypt($id));

        

		$favorites14->update($request->all());

		return redirect()->route(config('quickadmin.route').'.favorites14.index');
	}

	/**
	 * Remove the specified favorites14 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Favorites14::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.favorites14.index');
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
            Favorites14::destroy($toDelete);
        } else {
            Favorites14::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.favorites14.index');
    }

}
