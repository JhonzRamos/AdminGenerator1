<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Favorites24;
use App\Http\Requests\CreateFavorites24Request;
use App\Http\Requests\UpdateFavorites24Request;
use Illuminate\Http\Request;

use App\Books;
use App\Favorites24Books;


class Favorites24Controller extends Controller {

	/**
	 * Display a listing of favorites24
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $favorites24 = Favorites24::get();

		return view('admin.favorites24.index', compact('favorites24'));
	}

	/**
	 * Show the form for creating a new favorites24
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

	    $favorites24 = Favorites24::all();
 		 $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

        	    
        	    return view('admin.favorites24.create', compact("books"));
	}

	/**
	 * Store a newly created favorites24 in storage.
	 *
     * @param CreateFavorites24Request|Request $request
	 */
	public function store(CreateFavorites24Request $request)
	{
	    

		$model = Favorites24::create($request->all());

		//save item
        for($i = 0; $i < sizeof($request->books_id); $i++){
        	Favorites24Books::create([ 'favorites24_id' => $model->id, 'books_id' =>intval($request->books_id[$i])]);
        }

		return redirect()->route(config('quickadmin.route').'.favorites24.index');
	}

	/**
	 * Show the form for editing the specified favorites24.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$favorites24 = Favorites24::find(decrypt($id));

		$old_books= array();

        foreach ($favorites24->books as $key) {
        			$old_books[]= $key->books_id;
        }

	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    
		return view('admin.favorites24.edit', compact('favorites24', "books", "old_books"));
	}

	/**
	 * Update the specified favorites24 in storage.
     * @param UpdateFavorites24Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFavorites24Request $request)
	{



		$favorites24 = Favorites24::findOrFail(decrypt($id));



		$model = $favorites24->update($request->all());




		return redirect()->route(config('quickadmin.route').'.favorites24.index');
	}

	/**
	 * Remove the specified favorites24 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Favorites24::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.favorites24.index');
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
            Favorites24::destroy($toDelete);
        } else {
            Favorites24::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.favorites24.index');
    }

}
