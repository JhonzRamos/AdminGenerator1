<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\RelationshipDebug3;
use App\Http\Requests\CreateRelationshipDebug3Request;
use App\Http\Requests\UpdateRelationshipDebug3Request;
use Illuminate\Http\Request;

use App\Relationship;


class RelationshipDebug3Controller extends Controller {

	/**
	 * Display a listing of relationshipdebug3
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $relationshipdebug3 = RelationshipDebug3::with("relationship")->get();

		return view('admin.relationshipdebug3.index', compact('relationshipdebug3'));
	}

	/**
	 * Show the form for creating a new relationshipdebug3
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $relationship = Relationship::pluck("user_id", "id")->prepend('Please select', 0);

	    
	    return view('admin.relationshipdebug3.create', compact("relationship"));
	}

	/**
	 * Store a newly created relationshipdebug3 in storage.
	 *
     * @param CreateRelationshipDebug3Request|Request $request
	 */
	public function store(CreateRelationshipDebug3Request $request)
	{
	    
		RelationshipDebug3::create($request->all());

		return redirect()->route(config('quickadmin.route').'.relationshipdebug3.index');
	}

	/**
	 * Show the form for editing the specified relationshipdebug3.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$relationshipdebug3 = RelationshipDebug3::find(decrypt($id));
	    $relationship = Relationship::pluck("user_id", "id")->prepend('Please select', 0);

	    
		return view('admin.relationshipdebug3.edit', compact('relationshipdebug3', "relationship"));
	}

	/**
	 * Update the specified relationshipdebug3 in storage.
     * @param UpdateRelationshipDebug3Request|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateRelationshipDebug3Request $request)
	{
		$relationshipdebug3 = RelationshipDebug3::findOrFail(decrypt($id));

        

		$relationshipdebug3->update($request->all());

		return redirect()->route(config('quickadmin.route').'.relationshipdebug3.index');
	}

	/**
	 * Remove the specified relationshipdebug3 from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		RelationshipDebug3::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.relationshipdebug3.index');
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
            RelationshipDebug3::destroy($toDelete);
        } else {
            RelationshipDebug3::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.relationshipdebug3.index');
    }

}
