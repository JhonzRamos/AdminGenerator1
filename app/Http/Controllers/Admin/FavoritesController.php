<?php

namespace App\Http\Controllers\Admin;

use App\FavoritesBooks;
use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Favorites;
use App\Books;
use App\Http\Requests\CreateFavoritesRequest;
use App\Http\Requests\UpdateFavoritesRequest;
use Illuminate\Http\Request;



class FavoritesController extends Controller {

	/**
	 * Display a listing of favorites
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
		$favorites = Favorites::all();

		return view('admin.favorites.index', compact('favorites'));
	}

	/**
	 * Show the form for creating a new favorites
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
		$books = Books::pluck("sTitle", "id")->prepend('Please select', 0);


		return view('admin.favorites.create', compact("books"));


	}

	/**
	 * Store a newly created favorites in storage.
	 *
     * @param CreateFavoritesRequest|Request $request
	 */
	public function store(CreateFavoritesRequest $request)
	{

		$model = Favorites::create($request->all());

		//save item
		for($i = 0; $i < sizeof($request->books_id); $i++){
			FavoritesBooks::create([ 'favorites_id' => $model->id, 'books_id' =>intval($request->books_id[$i])]);
		}

		return redirect()->route(config('quickadmin.route').'.favorites.index');
	}

	/**
	 * Show the form for editing the specified favorites.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$favorites = Favorites::find(decrypt($id));
		$books = Books::pluck("sTitle", "id")->prepend('Please select', 0);


		return view('admin.favorites.edit', compact('favorites', "books"));
	}

	/**
	 * Update the specified favorites in storage.
     * @param UpdateFavoritesRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFavoritesRequest $request)
	{
		$favorites = Favorites::findOrFail(decrypt($id));

        

		$favorites->update($request->all());

		return redirect()->route(config('quickadmin.route').'.favorites.index');
	}

	/**
	 * Remove the specified favorites from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Favorites::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.favorites.index');
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
            Favorites::destroy($toDelete);
        } else {
            Favorites::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.favorites.index');
    }

}
