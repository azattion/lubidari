<?php namespace App\Http\Controllers;

use App\Category;
use App\Label;
use App\Photo;
use App\Product;
use App\Http\Requests\ProductRequest;
use App\ProductLabel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Product::latest()->paginate(10);
        return view('product.index', ['data' => $data]);
    }

    /**
     * All resource
     *
     *  @return Response
     */
    public function listing()
    {
       $data = Product::latest()->paginate(10);
       return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $category = Category::all();
        $label = [];
        $label[1] = Label::where("id_cat",1)->get();
        $label[2] = Label::where("id_cat",2)->get();
        $label[3] = Label::where("id_cat",3)->get();
        return view('product.add',compact('category','label'));
    }

    /**
     * Store a newly created resource in storage.
     * @param ProductRequest $request
     * @return Response
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());
        if($request->photo){
            $request->photo = rtrim($request->photo, ",");
            $photoArr = explode(",", $request->photo);
            foreach($photoArr as $one){
                $photo = Photo::find($one);
                $photo->id_prod = $product->id;
                $photo->save();
            }
        }
        if($request->label){
            foreach($request->label as $one){
                $data=['id_prod' => $product->id,'id_lab' => $one];
                ProductLabel::create($data);
            }
        }
        return redirect('administrator/product')->with('message', 'Запись успешно создана.') -> withInput ();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function showAjax($id)
    {
        return response()->json(Product::find($id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return view('product.show', ['data' => Product::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::all();
        return view('product.edit', ['data' => Product::find($id),'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param ProductRequest $request
     * @return Response
     */
    public function update($id, ProductRequest $request)
    {

        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect('administrator/product')->with('message', 'Запись успешно изменена.') -> withInput ();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('administrator/product')->with('message', 'Запись успешно удалена.');
    }

}
