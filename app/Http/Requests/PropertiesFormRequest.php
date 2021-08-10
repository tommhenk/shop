<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertiesFormRequest extends FormRequest
{
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
        $rules = [];
        if($this->price_from !== null){
            $rules['price_from'] = 'integer|min:0';
        }
        if ($this->price_to !== null) {
            $rules['price_to'] = 'integer';
        }
        return $rules;
    }
}
