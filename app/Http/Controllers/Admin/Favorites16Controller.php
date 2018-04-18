<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Favorites16;
use App\Http\Requests\CreateFavorites16Request;
use App\Http\Requests\UpdateFavorites16Request;
use Illuminate\Http\Request;

use App\Books;
use App\Favorites16Books;


class Favorites16Controller extends Controller {

	/**
	 * Display a listing of favorites16
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $favorites16 = Favorites16::all();


		return view('admin.favorites16.index', compact('favorites16'));


	}

	/**
	 * Show the form for creating a new favorites16
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

	    $favorites16 = Favorites16::all();
 		 $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

        	    
        	    return view('admin.favorites16.create', compact("books"));
	}

	/**
	 * Store a newly created favorites16 in storage.
	 *
     * @param CreateFavorites16Request|Request $request
	 */
	public function store(CreateFavorites16Request $request)
	{


		$model = Favorites16::create($request->all());

		//save item
        for($i = 0; $i < sizeof($request->books_id); $i++){
        	Favorites16Books::create([ 'favorites16_id' => $model->id, 'books_id' =>intval($request->books_id[$i])]);
        }

		return redirect()->route(config('quickadmin.route').'.favorites16.index');
	}

	/**
	 * Show the form for editing the specified favorites16.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$favorites16 = Favorites16::find(decrypt($id));
	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    
		return view('admin.favorites16.edit', compact('favorites16', "books"));
	}

	/**
	 * Update the specified favorites16 in storage.
     * @param UpdateFavorites16Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFavorites16Request $request)
	{
		$favorites16 = Favorites16::findOrFail(decrypt($id));

        

		$favorites16->update($request->all());

		return redirect()->route(config('quickadmin.route').'.favorites16.index');
	}

	/**
	 * Remove the specified favorites16 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Favorites16::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.favorites16.index');
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
            Favorites16::destroy($toDelete);
        } else {
            Favorites16::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.favorites16.index');
    }

}
