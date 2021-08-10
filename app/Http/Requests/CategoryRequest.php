<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Gate::allows('moderator', new \App\Models\Category);
    }


    protected function getValidatorInstance() {
        $validator = parent::getValidatorInstance();
        $validator->sometimes('alias', 'unique:categories|max:255', function($input){
            if ($this->route()->hasParameter('category')) {
                $model = $this->route()->parameter('category');
                return ($model->alias !== $input->alias) && !empty($input->alias);
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
            'desc'=>'required'
        ];
    }
}
