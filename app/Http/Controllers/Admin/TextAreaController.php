<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\TextArea;
use App\Http\Requests\CreateTextAreaRequest;
use App\Http\Requests\UpdateTextAreaRequest;
use Illuminate\Http\Request;

use App\User;


class TextAreaController extends Controller {

	/**
	 * Display a listing of textarea
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $textarea = TextArea::with("user")->get();

		return view('admin.textarea.index', compact('textarea'));
	}

	/**
	 * Show the form for creating a new textarea
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $user = User::pluck("name", "id")->prepend('Please select', 0);

	    
	    return view('admin.textarea.create', compact("user"));
	}

	/**
	 * Store a newly created textarea in storage.
	 *
     * @param CreateTextAreaRequest|Request $request
	 */
	public function store(CreateTextAreaRequest $request)
	{
	    
		TextArea::create($request->all());

		return redirect()->route(config('quickadmin.route').'.textarea.index');
	}

	/**
	 * Show the form for editing the specified textarea.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$textarea = TextArea::find($id);
	    $user = User::pluck("name", "id")->prepend('Please select', 0);

	    
		return view('admin.textarea.edit', compact('textarea', "user"));
	}

	/**
	 * Update the specified textarea in storage.
     * @param UpdateTextAreaRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateTextAreaRequest $request)
	{
		$textarea = TextArea::findOrFail($id);

        

		$textarea->update($request->all());

		return redirect()->route(config('quickadmin.route').'.textarea.index');
	}

	/**
	 * Remove the specified textarea from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		TextArea::destroy($id);

		return redirect()->route(config('quickadmin.route').'.textarea.index');
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
            TextArea::destroy($toDelete);
        } else {
            TextArea::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.textarea.index');
    }

}
