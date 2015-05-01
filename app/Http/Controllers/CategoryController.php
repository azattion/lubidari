<?php namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('category.index',['data'=>Category::paginate(5)]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('category.add');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\CategoryRequest $request
     * @return Response
     */
	public function store(Requests\CategoryRequest $request)
	{
        Category::create($request->all());
        return redirect('category');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('category.edit',['data'=>Category::find($id)]);
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Requests\CategoryRequest $request
     * @return Response
     */
	public function update($id, Requests\CategoryRequest $request)
	{
        $product = Category::findOrFail($id);
        $product->update($request->all());
        return redirect('category');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Category::find($id)->delete();
        return redirect()->back();
	}

}
