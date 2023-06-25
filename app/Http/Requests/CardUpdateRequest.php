<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CardUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'name' => ['required', 'between:1,255', Rule::unique('cards')->ignore($this->card)],
            'price' => ['required', 'numeric', 'min:0.01', 'regex:/^\d+(,\d{1,2})?(\.\d{1,2})?$/'],
            'description' => ['required'],
            'atk' => [
                Rule::requiredIf(function () {
                    return request()->input('card_type_id') === '1';
                }),
                'nullable',
                'min:0',
                'regex:/^\d+$|^\?$/',
            ],
            'def' => [
                Rule::requiredIf(function () {
                    return request()->input('card_type_id') === '1';
                }),
                'nullable',
                'min:0',
                'regex:/^\d+$|^\?$/',
            ],
            'level' => [
                Rule::requiredIf(function () {
                    return request()->input('card_type_id') === '1';

                }),

                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    if (request()->input('monster_class_id') === '7' && $value > 8) {
                        $fail('The max value for Level when Monster Class is selected is 8.');
                    } elseif ($value > 13) {
                        $fail('The max value for Level is 13.');
                    }
                },
            ],
            'monster_attribute_id' => [
                Rule::requiredIf(function () {
                    return request()->input('card_type_id') === '1';
                }),
                'nullable',
            ],
            'monster_class_id' => [
                Rule::requiredIf(function () {
                    return request()->input('card_type_id') === '1';
                }),
                'nullable',
            ],
            'monster_type_id' => [
                Rule::requiredIf(function () {
                    return request()->input('card_type_id') === '1';
                }),
                'nullable',
            ],
            'spell_type_id' => [
                Rule::requiredIf(function () {
                    return request()->input('card_type_id') === '2';
                }),
                'nullable',
            ],
            'trap_type_id' => [
                Rule::requiredIf(function () {
                    return request()->input('card_type_id') === '3';
                }),
                'nullable',]
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.between' => 'Name between 5 and 255 characters required',
            'name.unique' => 'Name must be unique',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price can only be a number',
            'price.regex' => 'test',
            'description' => 'Description is required',
            'atk.required' => 'ATK is required for monster cards',
            'atk.regex' => 'ATK must be a number or a ?',
            'atk.min'=> 'ATK must be minimum of 0',
            'def.required' => 'DEF is required for monster cards',
            'def.regex' => 'DEF must be a number or a ?',
            'def.min'=> 'DEF must be minimum of 0',
            'level.required' => 'level is required for monster cards',
            'level.numeric' => 'level must be a number',
            'level.min'=> 'level must be minimum of 0',
            'level.max'=> 'level must be maximum of 13',
            'monster_attribute_id.required' => 'monster attribute is required for monster cards',
            'monster_class_id.required' => 'monster class is required for monster cards',
            'monster_type_id.required' => 'monster type is required for monster cards',
            'spell_type_id.required' => 'Spell type is required for spell cards',
            'trap_type_id.required' => 'Trap type is required for trap cards',
        ];
    }
}
