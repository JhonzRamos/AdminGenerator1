<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Favorites22;
use App\Http\Requests\CreateFavorites22Request;
use App\Http\Requests\UpdateFavorites22Request;
use Illuminate\Http\Request;

use App\Books;
use App\Favorites22Books;


class Favorites22Controller extends Controller {

	/**
	 * Display a listing of favorites22
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $favorites22 = Favorites22::get();

		return view('admin.favorites22.index', compact('favorites22'));
	}

	/**
	 * Show the form for creating a new favorites22
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

	    $favorites22 = Favorites22::all();
 		 $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

        	    
        	    return view('admin.favorites22.create', compact("books"));
	}

	/**
	 * Store a newly created favorites22 in storage.
	 *
     * @param CreateFavorites22Request|Request $request
	 */
	public function store(CreateFavorites22Request $request)
	{
	    

		$model = Favorites22::create($request->all());

		//save item
        for($i = 0; $i < sizeof($request->books_id); $i++){
        	Favorites22Books::create([ 'favorites22_id' => $model->id, 'books_id' =>intval($request->books_id[$i])]);
        }

		return redirect()->route(config('quickadmin.route').'.favorites22.index');
	}

	/**
	 * Show the form for editing the specified favorites22.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$favorites22 = Favorites22::find(decrypt($id));

		$old_books= array();

        foreach ($favorites22->books as $key) {
        			$old_books[]= $key->books_id;
        }

	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    
		return view('admin.favorites22.edit', compact('favorites22', "books", "old_books"));
	}

	/**
	 * Update the specified favorites22 in storage.
     * @param UpdateFavorites22Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFavorites22Request $request)
	{
		$favorites22 = Favorites22::findOrFail(decrypt($id));

        

		$favorites22->update($request->all());

		return redirect()->route(config('quickadmin.route').'.favorites22.index');
	}

	/**
	 * Remove the specified favorites22 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Favorites22::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.favorites22.index');
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
            Favorites22::destroy($toDelete);
        } else {
            Favorites22::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.favorites22.index');
    }

}
