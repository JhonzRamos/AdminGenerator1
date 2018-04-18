<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Favorites20;
use App\Http\Requests\CreateFavorites20Request;
use App\Http\Requests\UpdateFavorites20Request;
use Illuminate\Http\Request;

use App\Books;
use App\Favorites20Books;


class Favorites20Controller extends Controller {

	/**
	 * Display a listing of favorites20
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $favorites20 = Favorites20::get();

		return view('admin.favorites20.index', compact('favorites20'));
	}

	/**
	 * Show the form for creating a new favorites20
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

	    $favorites20 = Favorites20::all();
 		 $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

        	    
        	    return view('admin.favorites20.create', compact("books"));
	}

	/**
	 * Store a newly created favorites20 in storage.
	 *
     * @param CreateFavorites20Request|Request $request
	 */
	public function store(CreateFavorites20Request $request)
	{
	    

		$model = Favorites20::create($request->all());

		//save item
        for($i = 0; $i < sizeof($request->books_id); $i++){
        	Favorites20Books::create([ 'favorites20_id' => $model->id, 'books_id' =>intval($request->books_id[$i])]);
        }

		return redirect()->route(config('quickadmin.route').'.favorites20.index');
	}

	/**
	 * Show the form for editing the specified favorites20.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$favorites20 = Favorites20::find(decrypt($id));

		$old_books= array();

        foreach ($favorites20->books as $key) {
        			$old_books[]= $key->books_id;
        }

	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    
		return view('admin.favorites20.edit', compact('favorites20', "books", "old_books"));
	}

	/**
	 * Update the specified favorites20 in storage.
     * @param UpdateFavorites20Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFavorites20Request $request)
	{
		$favorites20 = Favorites20::findOrFail(decrypt($id));

        

		$favorites20->update($request->all());

		return redirect()->route(config('quickadmin.route').'.favorites20.index');
	}

	/**
	 * Remove the specified favorites20 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Favorites20::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.favorites20.index');
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
            Favorites20::destroy($toDelete);
        } else {
            Favorites20::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.favorites20.index');
    }

}
