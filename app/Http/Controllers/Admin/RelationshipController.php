<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Relationship;
use App\Http\Requests\CreateRelationshipRequest;
use App\Http\Requests\UpdateRelationshipRequest;
use Illuminate\Http\Request;

use App\User;


class RelationshipController extends Controller {

	/**
	 * Display a listing of relationship
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $relationship = Relationship::with("user")->get();

		return view('admin.relationship.index', compact('relationship'));
	}

	/**
	 * Show the form for creating a new relationship
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $user = User::pluck("name", "id")->prepend('Please select', 0);

	    
	    return view('admin.relationship.create', compact("user"));
	}

	/**
	 * Store a newly created relationship in storage.
	 *
     * @param CreateRelationshipRequest|Request $request
	 */
	public function store(CreateRelationshipRequest $request)
	{
	    
		Relationship::create($request->all());

		return redirect()->route(config('quickadmin.route').'.relationship.index');
	}

	/**
	 * Show the form for editing the specified relationship.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$relationship = Relationship::find(decrypt($id));
	    $user = User::pluck("name", "id")->prepend('Please select', 0);

	    
		return view('admin.relationship.edit', compact('relationship', "user"));
	}

	/**
	 * Update the specified relationship in storage.
     * @param UpdateRelationshipRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateRelationshipRequest $request)
	{
		$relationship = Relationship::findOrFail(decrypt($id));

        

		$relationship->update($request->all());

		return redirect()->route(config('quickadmin.route').'.relationship.index');
	}

	/**
	 * Remove the specified relationship from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Relationship::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.relationship.index');
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
            Relationship::destroy($toDelete);
        } else {
            Relationship::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.relationship.index');
    }

}
