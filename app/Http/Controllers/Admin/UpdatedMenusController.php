<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\UpdatedMenus;
use App\Http\Requests\CreateUpdatedMenusRequest;
use App\Http\Requests\UpdateUpdatedMenusRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Books;
use App\UpdatedMenusBooks;
use App\User;


class UpdatedMenusController extends Controller {

	/**
	 * Display a listing of updatedmenus
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $updatedmenus = UpdatedMenus::with("user")->get();

		return view('admin.updatedmenus.index', compact('updatedmenus'));
	}

	/**
	 * Show the form for creating a new updatedmenus
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{

	    $updatedmenus = UpdatedMenus::all();
 		 $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);
$user = User::pluck("name", "id")->prepend('Please select', 0);

        	    
        $aEnum = UpdatedMenus::$aEnum;

        	    return view('admin.updatedmenus.create', compact("books", "user", "aEnum"));
	}

	/**
	 * Store a newly created updatedmenus in storage.
	 *
     * @param CreateUpdatedMenusRequest|Request $request
	 */
	public function store(CreateUpdatedMenusRequest $request)
	{
	    $request = $this->saveFiles($request);

		$model = UpdatedMenus::create($request->all());

		//save item
        for($i = 0; $i < sizeof($request->books_id); $i++){
        	UpdatedMenusBooks::create([ 'updatedmenus_id' => $model->id, 'books_id' =>intval($request->books_id[$i])]);
        }

		return redirect()->route(config('quickadmin.route').'.updatedmenus.index');
	}

	/**
	 * Show the form for editing the specified updatedmenus.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$updatedmenus = UpdatedMenus::find(decrypt($id));

		$old_books= array();

        foreach ($updatedmenus->books as $key) {
        			$old_books[]= $key->books_id;
        }

	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);
$user = User::pluck("name", "id")->prepend('Please select', 0);

	    
        $aEnum = UpdatedMenus::$aEnum;

		return view('admin.updatedmenus.edit', compact('updatedmenus', "books", "old_books", "user", "aEnum"));
	}

	/**
	 * Update the specified updatedmenus in storage.
     * @param UpdateUpdatedMenusRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateUpdatedMenusRequest $request)
	{
		$updatedmenus = UpdatedMenus::findOrFail(decrypt($id));

        $request = $this->saveFiles($request);

		$updatedmenus->update($request->all());

		return redirect()->route(config('quickadmin.route').'.updatedmenus.index');
	}

	/**
	 * Remove the specified updatedmenus from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		UpdatedMenus::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.updatedmenus.index');
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
            UpdatedMenus::destroy($toDelete);
        } else {
            UpdatedMenus::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.updatedmenus.index');
    }

}
