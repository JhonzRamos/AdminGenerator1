<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Favorites21;
use App\Http\Requests\CreateFavorites21Request;
use App\Http\Requests\UpdateFavorites21Request;
use Illuminate\Http\Request;

use App\Books;
use App\Favorites21Books;


class Favorites21Controller extends Controller {

	/**
	 * Display a listing of favorites21
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $favorites21 = Favorites21::get();

		return view('admin.favorites21.index', compact('favorites21'));
	}

	/**
	 * Show the form for creating a new favorites21
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

	    $favorites21 = Favorites21::all();
 		 $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

        	    
        	    return view('admin.favorites21.create', compact("books"));
	}

	/**
	 * Store a newly created favorites21 in storage.
	 *
     * @param CreateFavorites21Request|Request $request
	 */
	public function store(CreateFavorites21Request $request)
	{
	    

		$model = Favorites21::create($request->all());

		//save item
        for($i = 0; $i < sizeof($request->books_id); $i++){
        	Favorites21Books::create([ 'favorites21_id' => $model->id, 'books_id' =>intval($request->books_id[$i])]);
        }

		return redirect()->route(config('quickadmin.route').'.favorites21.index');
	}

	/**
	 * Show the form for editing the specified favorites21.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$favorites21 = Favorites21::find(decrypt($id));

		$old_books= array();

        foreach ($favorites21->books as $key) {
        			$old_books[]= $key->books_id;
        }

	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    
		return view('admin.favorites21.edit', compact('favorites21', "books", "old_books"));
	}

	/**
	 * Update the specified favorites21 in storage.
     * @param UpdateFavorites21Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFavorites21Request $request)
	{
		$favorites21 = Favorites21::findOrFail(decrypt($id));

        

		$favorites21->update($request->all());

		return redirect()->route(config('quickadmin.route').'.favorites21.index');
	}

	/**
	 * Remove the specified favorites21 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Favorites21::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.favorites21.index');
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
            Favorites21::destroy($toDelete);
        } else {
            Favorites21::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.favorites21.index');
    }

}
