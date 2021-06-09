<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutValidateRequest extends FormRequest
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

   public function rules()
    {
        return [
            'first_name'      => 'required',
            'last_name'       => 'required',
            'address_one'     => 'required',
            'phone'           => 'required',
            'email'           => 'required',
            'state'           => 'required',
            'city'            => 'required',
            'zip'             => 'required',
            'paymentMethod'  => 'required',
        ];
    }
    /**
     * Get the validation custom message that apply to the view.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required'     => 'Please Enter First Name',
            'last_name.required'      => 'Please Enter Last Name',
            'address_one.required'    => 'Please Enter Address',
            'phone.required'          => 'Please Enter Mobile No',
            'email.required'          => 'Please Enter Email',
            'state.required'          => 'Please Select District',
            'city.required'           => 'Please Select City',
            'zip.required'            => 'Please Select Zip Code',
            'paymentMethod.required' => 'Please Select Payment Option',
        ];
    }
}
