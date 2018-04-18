<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\AllMenus;
use App\Http\Requests\CreateAllMenusRequest;
use App\Http\Requests\UpdateAllMenusRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Books;
use App\AllMenusBooks;
use App\User;


class AllMenusController extends Controller {

	/**
	 * Display a listing of allmenus
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $allmenus = AllMenus::with("user")->get();

		return view('admin.allmenus.index', compact('allmenus'));
	}

	/**
	 * Show the form for creating a new allmenus
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

	    $allmenus = AllMenus::all();
 		 $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);
$user = User::pluck("name", "id")->prepend('Please select', 0);

        	    
        $sEnum = AllMenus::$sEnum;

        	    return view('admin.allmenus.create', compact("books", "user", "sEnum"));
	}

	/**
	 * Store a newly created allmenus in storage.
	 *
     * @param CreateAllMenusRequest|Request $request
	 */
	public function store(CreateAllMenusRequest $request)
	{
	    $request = $this->saveFiles($request);

		$model = AllMenus::create($request->all());

		//save item
        for($i = 0; $i < sizeof($request->books_id); $i++){
        	AllMenusBooks::create([ 'allmenus_id' => $model->id, 'books_id' =>intval($request->books_id[$i])]);
        }

		return redirect()->route(config('quickadmin.route').'.allmenus.index');
	}

	/**
	 * Show the form for editing the specified allmenus.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$allmenus = AllMenus::find(decrypt($id));

		$old_books= array();

        foreach ($allmenus->books as $key) {
        			$old_books[]= $key->books_id;
        }

	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);
$user = User::pluck("name", "id")->prepend('Please select', 0);

	    
        $sEnum = AllMenus::$sEnum;

		return view('admin.allmenus.edit', compact('allmenus', "books", "old_books", "user", "sEnum"));
	}

	/**
	 * Update the specified allmenus in storage.
     * @param UpdateAllMenusRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateAllMenusRequest $request)
	{
		$allmenus = AllMenus::findOrFail(decrypt($id));

        $request = $this->saveFiles($request);

		$allmenus->update($request->all());

		return redirect()->route(config('quickadmin.route').'.allmenus.index');
	}

	/**
	 * Remove the specified allmenus from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		AllMenus::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.allmenus.index');
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
            AllMenus::destroy($toDelete);
        } else {
            AllMenus::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.allmenus.index');
    }

}
