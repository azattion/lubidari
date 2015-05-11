<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrderRequest extends Request {

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
            'user_id' => 'integer',
            'name' => 'required|min:2|max:255',
            'phone' => 'required|min:6',
            'address' => 'required|min:2|max:255',
            'options' => 'required|integer',
            'count' => 'required|integer',
            'delivery_date' => 'date',
            'delivery_time' => 'date',
            'desc' => 'min:2|max:255'
        ];
	}

}
