<?php

namespace LaravelEnso\AddressesManager\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateAddressRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return config('enso.addresses.validations');
    }
}
