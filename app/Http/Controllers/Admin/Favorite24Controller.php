<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Favorite24;
use App\Http\Requests\CreateFavorite24Request;
use App\Http\Requests\UpdateFavorite24Request;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Books;
use App\Favorite24Books;


class Favorite24Controller extends Controller {

	/**
	 * Display a listing of favorite24
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $favorite24 = Favorite24::get();

		return view('admin.favorite24.index', compact('favorite24'));
	}

	/**
	 * Show the form for creating a new favorite24
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

	    $favorite24 = Favorite24::all();
 		 $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

        	    
        	    return view('admin.favorite24.create', compact("books"));
	}

	/**
	 * Store a newly created favorite24 in storage.
	 *
     * @param CreateFavorite24Request|Request $request
	 */
	public function store(CreateFavorite24Request $request)
	{
	    $request = $this->saveFiles($request);

		$model = Favorite24::create($request->all());

		//save item
        for($i = 0; $i < sizeof($request->books_id); $i++){
        	Favorite24Books::create([ 'favorite24_id' => $model->id, 'books_id' =>intval($request->books_id[$i])]);
        }

		return redirect()->route(config('quickadmin.route').'.favorite24.index');
	}

	/**
	 * Show the form for editing the specified favorite24.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$favorite24 = Favorite24::find(decrypt($id));

		$old_books= array();

        foreach ($favorite24->books as $key) {
        			$old_books[]= $key->books_id;
        }

	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    
		return view('admin.favorite24.edit', compact('favorite24', "books", "old_books"));
	}

	/**
	 * Update the specified favorite24 in storage.
     * @param UpdateFavorite24Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateFavorite24Request $request)
	{
		$favorite24 = Favorite24::findOrFail(decrypt($id));

        $request = $this->saveFiles($request);

		$favorite24->update($request->all());

		return redirect()->route(config('quickadmin.route').'.favorite24.index');
	}

	/**
	 * Remove the specified favorite24 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Favorite24::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.favorite24.index');
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
            Favorite24::destroy($toDelete);
        } else {
            Favorite24::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.favorite24.index');
    }

}
