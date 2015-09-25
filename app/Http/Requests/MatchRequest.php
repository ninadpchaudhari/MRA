<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MatchRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // See if its only admin
        //States cannot add matches
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
            'name'=> ['required','min:3','max:255'],
            'place' => ['required','min:3','max:50'],
            'start_date' => ['required', 'date_format:d-m-Y'],
            'end_date' => ['required','date_format:d-m-Y','after:start_date'],
            'short_name' => ['required' , 'min:3','max:15'],
            'year' => ['required','digits:4']
        ];
    }
}
