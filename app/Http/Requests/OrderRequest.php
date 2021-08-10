<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        return [
            'number'=>'required|min:5|max:16'
        ];
    }

    protected function getValidatorInstance() {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('email', 'email', function($input){
            if (!empty($input['email'])) {
                return true;
            }
        });

        return $validator;
    }
}
