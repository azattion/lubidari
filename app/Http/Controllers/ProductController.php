<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $data = Product::orderBy('created_at', 'DESC')->paginate(2);
		return view('product.index',['data'=>$data]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('product.add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::all();
        $val = Validator::make($data, Product::$rules);
        if ($val->fails()) {
            return redirect()->back()->withErrors($val->messages());
        }
        if(Product::add($data)){
            Session::flash('message', 'Товар успешно добавлен!');
        }else{
            return redirect()->back()->withErrors('Ошибка при удаление товара');
        }
        return Redirect::to('/product');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return view('product.show',['data' => Product::find($id)]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('product.edit',['data' => Product::find($id)->first()]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $data = Input::all();
        $val = Validator::make($data, Product::$rules);
        if ($val->fails()) {
            return redirect()->back()->withErrors($val->messages());
        }
        if(Product::up_data($id,$data)){
            Session::flash('message', 'Товар успешно добавлен!');
        }else{
            return redirect()->back()->withErrors('Ошибка при удаление товара');
        }
       // return Redirect::to('/product/'.$id.'/show');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Product::destroy($id)){
            Session::flash('message', 'Товар успешно добавлен!');
        }else{
            return redirect()->back()->withErrors('Ошибка при удаление товара');
        }
        return Redirect::to('/product/'.$id.'/edit');
	}

}
