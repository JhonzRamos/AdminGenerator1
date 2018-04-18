<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\RelationshipDebug2;
use App\Http\Requests\CreateRelationshipDebug2Request;
use App\Http\Requests\UpdateRelationshipDebug2Request;
use Illuminate\Http\Request;

use App\User;


class RelationshipDebug2Controller extends Controller {

	/**
	 * Display a listing of relationshipdebug2
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $relationshipdebug2 = RelationshipDebug2::with("user")->get();

		return view('admin.relationshipdebug2.index', compact('relationshipdebug2'));
	}

	/**
	 * Show the form for creating a new relationshipdebug2
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $user = User::pluck("name", "id")->prepend('Please select', 0);

	    
	    return view('admin.relationshipdebug2.create', compact("user"));
	}

	/**
	 * Store a newly created relationshipdebug2 in storage.
	 *
     * @param CreateRelationshipDebug2Request|Request $request
	 */
	public function store(CreateRelationshipDebug2Request $request)
	{
	    
		RelationshipDebug2::create($request->all());

		return redirect()->route(config('quickadmin.route').'.relationshipdebug2.index');
	}

	/**
	 * Show the form for editing the specified relationshipdebug2.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$relationshipdebug2 = RelationshipDebug2::find(decrypt($id));
	    $user = User::pluck("name", "id")->prepend('Please select', 0);

	    
		return view('admin.relationshipdebug2.edit', compact('relationshipdebug2', "user"));
	}

	/**
	 * Update the specified relationshipdebug2 in storage.
     * @param UpdateRelationshipDebug2Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateRelationshipDebug2Request $request)
	{
		$relationshipdebug2 = RelationshipDebug2::findOrFail(decrypt($id));

        

		$relationshipdebug2->update($request->all());

		return redirect()->route(config('quickadmin.route').'.relationshipdebug2.index');
	}

	/**
	 * Remove the specified relationshipdebug2 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		RelationshipDebug2::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.relationshipdebug2.index');
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
            RelationshipDebug2::destroy($toDelete);
        } else {
            RelationshipDebug2::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.relationshipdebug2.index');
    }

}
