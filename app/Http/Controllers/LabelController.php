<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Label;
use Illuminate\Http\Request;

class LabelController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Label::paginate(50);
        $cat = Label::$category;
        return view('label.index', compact('data','cat'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('label.add');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\LabelRequest $request
     * @return Response
     */
	public function store(Requests\LabelRequest $request)
	{
		Label::create($request->all());
        return redirect('administrator/label')->with('message', 'Запись успешно изменена.') -> withInput ();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function show($id)
	{
		//
	}*/

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $data = Label::findOrFail($id);
		return view('label.edit', compact('data'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Requests\LabelRequest $request
     * @return Response
     */
	public function update($id, Requests\LabelRequest $request)
	{
        $label = Label::findOrFail($id);
        $label->update($request->all());
        return redirect('administrator/label')->with('message', 'Запись успешно изменена.') -> withInput ();
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $label = Label::findOrFail($id);
        $label->delete();
        return redirect('administrator/label')->with('message', 'Запись успешно удалена.');

    }

}
