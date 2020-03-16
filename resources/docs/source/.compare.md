---
title: API Reference

language_tabs:
- bash
- javascript
- php
- python

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://tl-discount.docksal/docs/collection.json)

<!-- END_INFO -->

#Discounts for orders


APIs for discounts
<!-- START_2932a8824bf86fbc99b8ebca644edd5e -->
## api/discount
> Example request:

```bash
curl -X POST \
    "http://tl-discount.docksal/api/discount" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"id":9,"customer-id":"sint","items":[{"product-id":"nisi","quantity":14,"unit-price":1,"total":56535.688401}],"total":102784223.42975235,"language":"qui"}'

```

```javascript
const url = new URL(
    "http://tl-discount.docksal/api/discount"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "id": 9,
    "customer-id": "sint",
    "items": [
        {
            "product-id": "nisi",
            "quantity": 14,
            "unit-price": 1,
            "total": 56535.688401
        }
    ],
    "total": 102784223.42975235,
    "language": "qui"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://tl-discount.docksal/api/discount',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer {token}',
        ],
        'json' => [
            'id' => 9,
            'customer-id' => 'sint',
            'items' => [
                [
                    'product-id' => 'nisi',
                    'quantity' => 14,
                    'unit-price' => 1.0,
                    'total' => 56535.688401,
                ],
            ],
            'total' => 102784223.42975235,
            'language' => 'qui',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://tl-discount.docksal/api/discount'
payload = {
    "id": 9,
    "customer-id": "sint",
    "items": [
        {
            "product-id": "nisi",
            "quantity": 14,
            "unit-price": 1,
            "total": 56535.688401
        }
    ],
    "total": 102784223.42975235,
    "language": "qui"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
  'Authorization': 'Bearer {token}'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```


> Example response (200):

```json
{
    "data": {
        "discounts": [
            {
                "amount": null,
                "message": null
            },
            {
                "amount": null,
                "message": null
            }
        ]
    }
}
```

### HTTP Request
`POST api/discount`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | The id of the order.
        `customer-id` | required |  optional  | integer The id of the customer.
        `items` | array |  required  | OrderItems
        `items.*.product-id` | string |  required  | Product Id of the orderitem
        `items.*.quantity` | integer |  required  | Quantity of the orderitem
        `items.*.unit-price` | float |  required  | Unit Price of the orderitem
        `items.*.total` | float |  required  | Total of the orderitem
        `total` | float |  required  | Total amount of the order.
        `language` | string |  optional  | Language, default nl, available ( nl / fr )
    
<!-- END_2932a8824bf86fbc99b8ebca644edd5e -->


