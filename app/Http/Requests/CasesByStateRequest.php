<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CasesByStateRequest extends FormRequest
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
        $ufs = 'AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC';

        return [
            'date' => 'required|string|date_format:d/m/Y',
            'state' => "required|string|size:2|in:{$ufs}"
        ];
    }
}
