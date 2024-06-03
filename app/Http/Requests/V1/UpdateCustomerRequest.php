<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
        $method = $this->method();
        if($method=='PUT') {
            return [
                'name' => 'required|string',
                'type' => 'required|in:individual,business',
                'email' => 'required|email',
                'address' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|string',
                'postalCode' => 'required|string',
            ];
        }elseif($method=='PATCH'){
            return [
                'name' => 'string',
                'type' => 'in:individual,business',
                'email' => 'email',
                'address' => 'string',
                'city' => 'string',
                'state' => 'string',
                'postalCode' => 'string',
            ];
        }
       
    }
}
