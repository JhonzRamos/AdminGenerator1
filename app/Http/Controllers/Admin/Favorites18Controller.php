<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Favorites18;
use App\Http\Requests\CreateFavorites18Request;
use App\Http\Requests\UpdateFavorites18Request;
use Illuminate\Http\Request;

use App\Books;
use App\Favorites18Books;


class Favorites18Controller extends Controller {

	/**
	 * Display a listing of favorites18
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $favorites18 = Favorites18::get();

		return view('admin.favorites18.index', compact('favorites18'));
	}

	/**
	 * Show the form for creating a new favorites18
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

	    $favorites18 = Favorites18::all();
 		 $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

        	    
        	    return view('admin.favorites18.create', compact("books"));
	}

	/**
	 * Store a newly created favorites18 in storage.
	 *
     * @param CreateFavorites18Request|Request $request
	 */
	public function store(CreateFavorites18Request $request)
	{
	    

		$model = Favorites18::create($request->all());

		//save item
        for($i = 0; $i < sizeof($request->books_id); $i++){
        	Favorites18Books::create([ 'favorites18_id' => $model->id, 'books_id' =>intval($request->books_id[$i])]);
        }

		return redirect()->route(config('quickadmin.route').'.favorites18.index');
	}

	/**
	 * Show the form for editing the specified favorites18.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$favorites18 = Favorites18::find(decrypt($id));
	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    
		return view('admin.favorites18.edit', compact('favorites18', "books"));
	}

	/**
	 * Update the specified favorites18 in storage.
     * @param UpdateFavorites18Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFavorites18Request $request)
	{
		$favorites18 = Favorites18::findOrFail(decrypt($id));

        

		$favorites18->update($request->all());

		return redirect()->route(config('quickadmin.route').'.favorites18.index');
	}

	/**
	 * Remove the specified favorites18 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Favorites18::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.favorites18.index');
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
            Favorites18::destroy($toDelete);
        } else {
            Favorites18::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.favorites18.index');
    }

}
