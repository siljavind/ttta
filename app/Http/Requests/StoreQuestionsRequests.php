<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionsRequests extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'question_id' => 'required|unique:questions,question_id|integer',
        ];
    }
}
