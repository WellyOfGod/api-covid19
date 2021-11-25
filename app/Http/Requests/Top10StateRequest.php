<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Top10StateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $ufs = 'AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC';

        return [
            'state' => "required|string|size:2|in:{$ufs}",
            'dateStart' => 'required|string|date_format:d/m/Y',
            'dateEnd' => 'required|string|date_format:d/m/Y',
            'position' => 'nullable|integer|between:0,9'
        ];
    }
}
