<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'name' => 'required|min:2|max:30',
			'description' => 'required|min:2|max:50',
			'image' => 'required'
		];
	}
	
	protected function failedValidation(Validator $validator)
	{
		$errors = $validator->errors();
		
		$response = response()->json([
			'message' => 'Invalid data send',
			'details' => $errors->messages(),
		], 422);
		
		throw new HttpResponseException($response);
	}
	
}
