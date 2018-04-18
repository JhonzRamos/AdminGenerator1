<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Favorites15;
use App\Http\Requests\CreateFavorites15Request;
use App\Http\Requests\UpdateFavorites15Request;
use Illuminate\Http\Request;

use App\Books;
use App\Favorites15Books;


class Favorites15Controller extends Controller {

	/**
	 * Display a listing of favorites15
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $favorites15 = Favorites15::get();

		return view('admin.favorites15.index', compact('favorites15'));
	}

	/**
	 * Show the form for creating a new favorites15
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

	    $favorites15 = Favorites15::all();
 		$books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    

        return view('admin.favorites15.create', compact('books'));
	}

	/**
	 * Store a newly created favorites15 in storage.
	 *
     * @param CreateFavorites15Request|Request $request
	 */
	public function store(CreateFavorites15Request $request)
	{
	    

		$model = Favorites15::create($request->all());

		//save item
        for($i = 0; $i < sizeof($request->books_id); $i++){
        	Favorites15Books::create([ 'favorites15_id' => $model->id, 'books_id' =>intval($request->books_id[$i])]);
        }

		return redirect()->route(config('quickadmin.route').'.favorites15.index');
	}

	/**
	 * Show the form for editing the specified favorites15.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$favorites15 = Favorites15::find(decrypt($id));
	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    
		return view('admin.favorites15.edit', compact('favorites15', "books"));
	}

	/**
	 * Update the specified favorites15 in storage.
     * @param UpdateFavorites15Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFavorites15Request $request)
	{
		$favorites15 = Favorites15::findOrFail(decrypt($id));

        

		$favorites15->update($request->all());

		return redirect()->route(config('quickadmin.route').'.favorites15.index');
	}

	/**
	 * Remove the specified favorites15 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Favorites15::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.favorites15.index');
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
            Favorites15::destroy($toDelete);
        } else {
            Favorites15::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.favorites15.index');
    }

}
