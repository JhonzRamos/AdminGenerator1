<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateExampleMenuRequest extends FormRequest {

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
            'sPhoto' => 'required', 
            'sLocation' => 'required', 
            'bToggle' => 'required', 
            'sDesc' => 'required', 
            'sDesc2' => 'required', 
            'sFile' => 'max:2048|required', 
            'oEnum' => 'required', 
            'sPassword' => 'required', 
            
		];
	}
}
