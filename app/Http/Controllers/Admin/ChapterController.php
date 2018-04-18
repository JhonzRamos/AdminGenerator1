<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Chapter;
use App\Http\Requests\CreateChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use Illuminate\Http\Request;

use App\Books;


class ChapterController extends Controller {

	/**
	 * Display a listing of chapter
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $chapter = Chapter::with("books")->get();

		return view('admin.chapter.index', compact('chapter'));
	}

	/**
	 * Show the form for creating a new chapter
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    
	    return view('admin.chapter.create', compact("books"));
	}

	/**
	 * Store a newly created chapter in storage.
	 *
     * @param CreateChapterRequest|Request $request
	 */
	public function store(CreateChapterRequest $request)
	{
	    
		Chapter::create($request->all());

		return redirect()->route(config('quickadmin.route').'.chapter.index');
	}

	/**
	 * Show the form for editing the specified chapter.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$chapter = Chapter::find(decrypt($id));
	    $books = Books::pluck("sTitle", "id")->prepend('Please select', 0);

	    
		return view('admin.chapter.edit', compact('chapter', "books"));
	}

	/**
	 * Update the specified chapter in storage.
     * @param UpdateChapterRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateChapterRequest $request)
	{
		$chapter = Chapter::findOrFail(decrypt($id));

        

		$chapter->update($request->all());

		return redirect()->route(config('quickadmin.route').'.chapter.index');
	}

	/**
	 * Remove the specified chapter from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Chapter::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.chapter.index');
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
            Chapter::destroy($toDelete);
        } else {
            Chapter::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.chapter.index');
    }

}
