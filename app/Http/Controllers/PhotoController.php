<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Photo;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PhotoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('photo.index', ['data' => Photo::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\PhotoRequest $request
     * @return Response
     */
    public function store(Requests\PhotoRequest $request)
    {
        $imageName = date('Ymdhis') . '.' . $request->file('file')->getClientOriginalExtension();
        $request->file('file')->move(
            base_path() . '/public/img/uploads/', $imageName
        );
        $photo = Photo::create(
            ['title' => $request->file('file')->getClientOriginalName(),
            'filename' => $imageName,
            'url'=> '/public/img/uploads/', $imageName]
        );
        print $photo->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
