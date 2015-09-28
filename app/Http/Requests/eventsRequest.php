<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class eventsRequest extends Request
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
            //
            'match_id' => ['required', 'integer'],
            'name' => ['required'],
            'class' => ['required'],
            'type' => ['required'],
            'gender' => ['required'],

            'category' => ['required'],

            'max_score' => ['between:0.0,1500.0']
        ];
    }
}
