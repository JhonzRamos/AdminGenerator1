<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\RelationshipDebug;
use App\Http\Requests\CreateRelationshipDebugRequest;
use App\Http\Requests\UpdateRelationshipDebugRequest;
use Illuminate\Http\Request;

use App\Books;


class RelationshipDebugController extends Controller {

	/**
	 * Display a listing of relationshipdebug
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $relationshipdebug = RelationshipDebug::with("books")->get();

		return view('admin.relationshipdebug.index', compact('relationshipdebug'));
	}

	/**
	 * Show the form for creating a new relationshipdebug
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    
	    return view('admin.relationshipdebug.create', compact("books"));
	}

	/**
	 * Store a newly created relationshipdebug in storage.
	 *
     * @param CreateRelationshipDebugRequest|Request $request
	 */
	public function store(CreateRelationshipDebugRequest $request)
	{
	    
		RelationshipDebug::create($request->all());

		return redirect()->route(config('quickadmin.route').'.relationshipdebug.index');
	}

	/**
	 * Show the form for editing the specified relationshipdebug.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$relationshipdebug = RelationshipDebug::find(decrypt($id));
	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    
		return view('admin.relationshipdebug.edit', compact('relationshipdebug', "books"));
	}

	/**
	 * Update the specified relationshipdebug in storage.
     * @param UpdateRelationshipDebugRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateRelationshipDebugRequest $request)
	{
		$relationshipdebug = RelationshipDebug::findOrFail(decrypt($id));

        

		$relationshipdebug->update($request->all());

		return redirect()->route(config('quickadmin.route').'.relationshipdebug.index');
	}

	/**
	 * Remove the specified relationshipdebug from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		RelationshipDebug::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.relationshipdebug.index');
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
            RelationshipDebug::destroy($toDelete);
        } else {
            RelationshipDebug::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.relationshipdebug.index');
    }

}
