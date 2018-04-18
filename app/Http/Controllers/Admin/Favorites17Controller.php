<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Favorites17;
use App\Http\Requests\CreateFavorites17Request;
use App\Http\Requests\UpdateFavorites17Request;
use Illuminate\Http\Request;

use App\Books;
use App\Favorites17Books;


class Favorites17Controller extends Controller {

	/**
	 * Display a listing of favorites17
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $favorites17 = Favorites17::get();

		return view('admin.favorites17.index', compact('favorites17'));
	}

	/**
	 * Show the form for creating a new favorites17
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

	    $favorites17 = Favorites17::all();
 		 $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

        	    
        	    return view('admin.favorites17.create', compact("books"));
	}

	/**
	 * Store a newly created favorites17 in storage.
	 *
     * @param CreateFavorites17Request|Request $request
	 */
	public function store(CreateFavorites17Request $request)
	{
	    

		$model = Favorites17::create($request->all());

		//save item
        for($i = 0; $i < sizeof($request->books_id); $i++){
        	Favorites17Books::create([ 'favorites17_id' => $model->id, 'books_id' =>intval($request->books_id[$i])]);
        }

		return redirect()->route(config('quickadmin.route').'.favorites17.index');
	}

	/**
	 * Show the form for editing the specified favorites17.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$favorites17 = Favorites17::find(decrypt($id));
	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    
		return view('admin.favorites17.edit', compact('favorites17', "books"));
	}

	/**
	 * Update the specified favorites17 in storage.
     * @param UpdateFavorites17Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFavorites17Request $request)
	{
		$favorites17 = Favorites17::findOrFail(decrypt($id));

        

		$favorites17->update($request->all());

		return redirect()->route(config('quickadmin.route').'.favorites17.index');
	}

	/**
	 * Remove the specified favorites17 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Favorites17::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.favorites17.index');
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
            Favorites17::destroy($toDelete);
        } else {
            Favorites17::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.favorites17.index');
    }

}
