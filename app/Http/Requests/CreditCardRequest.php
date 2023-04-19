<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;

class CreditCardRequest extends FormRequest
{

    public function rules()
    {
        return [
            'agree' => ['exclude_if:store,0','required'],
            'full_name' => ['required', 'string'],
            'card_number' => ['required','max:16','min:15', 'exclude_if:store,0','unique:bank_accounts,card_number', new CardNumber],
            'expiration_year' => ['required', new CardExpirationYear($this->get('expiration_month'))],
            'expiration_month' => ['required', new CardExpirationMonth($this->get('expiration_year'))],
            'cvc' => ['required', new CardCvc($this->get('card_number'))]
        ];
    }
    public function messages()
    {
        // use trans instead on Lang
        return [
            'agree.required' => "Terms & Conditions field should be checked.",
        ];
    }
}
