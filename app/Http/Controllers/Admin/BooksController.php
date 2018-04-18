<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Books;
use App\Http\Requests\CreateBooksRequest;
use App\Http\Requests\UpdateBooksRequest;
use Illuminate\Http\Request;



class BooksController extends Controller {

	/**
	 * Display a listing of books
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $books = Books::all();

		return view('admin.books.index', compact('books'));
	}

	/**
	 * Show the form for creating a new books
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.books.create');
	}

	/**
	 * Store a newly created books in storage.
	 *
     * @param CreateBooksRequest|Request $request
	 */
	public function store(CreateBooksRequest $request)
	{
	    
		Books::create($request->all());

		return redirect()->route(config('quickadmin.route').'.books.index');
	}

	/**
	 * Show the form for editing the specified books.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$books = Books::find(decrypt($id));
	    
	    
		return view('admin.books.edit', compact('books'));
	}

	/**
	 * Update the specified books in storage.
     * @param UpdateBooksRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateBooksRequest $request)
	{
		$books = Books::findOrFail(decrypt($id));

        

		$books->update($request->all());

		return redirect()->route(config('quickadmin.route').'.books.index');
	}

	/**
	 * Remove the specified books from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Books::destroy(decrypt($id));

		return redirect()->route(config('quickadmin.route').'.books.index');
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
            Books::destroy($toDelete);
        } else {
            Books::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.books.index');
    }

}
