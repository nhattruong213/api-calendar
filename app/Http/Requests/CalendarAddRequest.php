<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalendarAddRequest extends FormRequest
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
            'event_id' => 'required',
            'date' => 'required',
            'content' => 'required',
            'img' => 'mimes:jpg,png'
        ];
    }
    public function messages()
    {
        return [
            'event_id.required' => 'Please select type job',
            'content.required'  => 'Please Enter content',
            'date.required'  => 'Please Enter date',
        ];
    }
}
