<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Fields\Order;
use App\Fields\OrderItem;

use App\Traits\ValidationField;

class DiscountRequest extends FormRequest
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
            Order::ID               =>  'required|integer',
            Order::CUSTOMER_ID      =>  'required|integer',
            Order::ITEMS            =>  'required|array',
            ValidationField::subArrayField( Order::ITEMS,OrderItem::PRODUCT_ID) => 'required',
            ValidationField::subArrayField( Order::ITEMS,OrderItem::QUANTITY) => 'required|numeric',
            ValidationField::subArrayField( Order::ITEMS,OrderItem::UNIT_PRICE) => 'required|numeric',
            ValidationField::subArrayField( Order::ITEMS,OrderItem::TOTAL) => 'required|numeric',
            Order::TOTAL            =>  'required|numeric'
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
