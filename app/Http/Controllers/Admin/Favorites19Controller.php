<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Favorites19;
use App\Http\Requests\CreateFavorites19Request;
use App\Http\Requests\UpdateFavorites19Request;
use Illuminate\Http\Request;

use App\Books;
use App\Favorites19Books;


class Favorites19Controller extends Controller {

	/**
	 * Display a listing of favorites19
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $favorites19 = Favorites19::get();

		return view('admin.favorites19.index', compact('favorites19'));
	}

	/**
	 * Show the form for creating a new favorites19
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

	    $favorites19 = Favorites19::all();
 		 $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

        	    
        	    return view('admin.favorites19.create', compact("books"));
	}

	/**
	 * Store a newly created favorites19 in storage.
	 *
     * @param CreateFavorites19Request|Request $request
	 */
	public function store(CreateFavorites19Request $request)
	{
	    

		$model = Favorites19::create($request->all());

		//save item
        for($i = 0; $i < sizeof($request->books_id); $i++){
        	Favorites19Books::create([ 'favorites19_id' => $model->id, 'books_id' =>intval($request->books_id[$i])]);
        }

		return redirect()->route(config('quickadmin.route').'.favorites19.index');


	}

	/**
	 * Show the form for editing the specified favorites19.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$favorites19 = Favorites19::find(decrypt($id));

		$old_books = array();

		foreach ($favorites19->books as $books) {
			$old_books[]= $books->books_id;
		}


	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    
		return view('admin.favorites19.edit', compact('favorites19', "books", "old_books"));
	}

	/**
	 * Update the specified favorites19 in storage.
     * @param UpdateFavorites19Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFavorites19Request $request)
	{
		$favorites19 = Favorites19::findOrFail(decrypt($id));

        

		$favorites19->update($request->all());

		return redirect()->route(config('quickadmin.route').'.favorites19.index');
	}

	/**
	 * Remove the specified favorites19 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Favorites19::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.favorites19.index');
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
            Favorites19::destroy($toDelete);
        } else {
            Favorites19::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.favorites19.index');
    }

}
