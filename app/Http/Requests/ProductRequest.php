<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'title' => 'required|min:2|max:255',
            'price' => 'required|numeric',
            'consist' => 'required|min:2|max:255',
            'desc' => 'required|min:2|max:255',
            'boxing' => 'required|min:2|max:255',
            'size' => 'required|min:2|max:255',
            'weight' => 'required|numeric',
            'prod_time' => 'required|numeric'
		];
	}

}
