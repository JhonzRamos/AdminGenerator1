<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Favorites23;
use App\Http\Requests\CreateFavorites23Request;
use App\Http\Requests\UpdateFavorites23Request;
use Illuminate\Http\Request;

use App\Books;
use App\Favorites23Books;


class Favorites23Controller extends Controller {

	/**
	 * Display a listing of favorites23
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $favorites23 = Favorites23::get();

		return view('admin.favorites23.index', compact('favorites23'));
	}

	/**
	 * Show the form for creating a new favorites23
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

	    $favorites23 = Favorites23::all();
 		 $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

        	    
        	    return view('admin.favorites23.create', compact("books"));
	}

	/**
	 * Store a newly created favorites23 in storage.
	 *
     * @param CreateFavorites23Request|Request $request
	 */
	public function store(CreateFavorites23Request $request)
	{
	    

		$model = Favorites23::create($request->all());

		//save item
		for($i = 0; $i < sizeof($request->books_id); $i++){
			Favorites23Books::create([ 'favorites23_id' => $model->id, 'books_id' =>intval($request->books_id[$i])]);
		}

		return redirect()->route(config('quickadmin.route').'.favorites23.index');
	}

	/**
	 * Show the form for editing the specified favorites23.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$favorites23 = Favorites23::find(decrypt($id));

		$old_books= array();

        foreach ($favorites23->books as $key) {
        			$old_books[]= $key->books_id;
        }

	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    
		return view('admin.favorites23.edit', compact('favorites23', "books", "old_books"));
	}

	/**
	 * Update the specified favorites23 in storage.
     * @param UpdateFavorites23Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFavorites23Request $request)
	{

		$favorites23 = Favorites23::findOrFail(decrypt($id));

        

		$favorites23->update($request->all());

		return redirect()->route(config('quickadmin.route').'.favorites23.index');
	}

	/**
	 * Remove the specified favorites23 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Favorites23::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.favorites23.index');
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
            Favorites23::destroy($toDelete);
        } else {
            Favorites23::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.favorites23.index');
    }

}
