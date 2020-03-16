<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\DiscountRequest;
use App\Http\Resources\Discounts;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Presenters\DiscountPresenter;

use App\Services\Discount\OrderDiscountService;
use App\Services\Discount\OrderRuleCollection;

/**
 * @group Discounts for orders
 *
 * APIs for discounts
 */
class DiscountController extends Controller
{
    /**
     * @bodyParam id int required The id of the order. Example: 9
     * @bodyParam customer-id required integer The id of the customer.
     * @bodyParam items array required OrderItems
     * @bodyParam items.*.product-id string required Product Id of the orderitem
     * @bodyParam items.*.quantity integer required Quantity of the orderitem
     * @bodyParam items.*.unit-price float required Unit Price of the orderitem
     * @bodyParam items.*.total float required Total of the orderitem
     * @bodyParam total float required Total amount of the order.
     * @bodyParam language string Language, default nl, available ( nl / fr )
     * @apiResourceCollection App\Http\Resources\Discounts
     * @apiResourceModel App\Models\Order
     */
    public function __invoke(DiscountRequest $request)
    {
        $model = new Order();
        $order = $model->fill($request->toArray());

        $discountRules = new OrderRuleCollection($order);

        $service = new OrderDiscountService($discountRules);
        $service->apply();

        $activeDiscounts = $service->getActiveDiscounts();

        return new Discounts(
            collect($activeDiscounts)->mapInto(DiscountPresenter::class)
        );
    }

}
