<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Gate::allows('edit', new \App\Models\Product);
    }

    protected function getValidatorInstance(){
        $validator = parent::getValidatorInstance();
        $validator->sometimes('alias', 'required|unique:products', function($input){
            if($this->route()->hasParameter('product')){
                $model = $this->route()->parameter('product');
                return ($model->alias != $input->alias) && !empty($input->alias);
            }
            return !empty($input->alias);
        });
        return $validator;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|max:255',
            'text'=>'required',
            'category_id'=>'required',
            'price'=>'required'
        ];
    }
}
